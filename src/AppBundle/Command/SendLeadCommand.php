<?php

namespace AppBundle\Command;

use AppBundle\Entity\Order;
use AppBundle\Entity\Stream;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author drilla
 */
class SendLeadCommand extends ContainerAwareCommand
{
    protected function configure() {
        $this
            ->setName('app:send_lead')
            ->setDescription('Отправляем лид в ZCPA');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        //берем все неотправленные лиды

        $manager = $this->getContainer()->get('doctrine')->getManager();

        /** @var EntityRepository $repo */
        $repo = $manager->getRepository(Order::class);

        /** @var Order[] $orders */
        $orders = $repo->createQueryBuilder('o')->where('o.isSent <> '. Order::IS_SENT)->getQuery()->getResult();


        foreach ($orders as $order) {
            echo "Отправляем лид...";

            $result = $this->_sendOrder($order);

            if ($result === true) {
                //помечаем те, которые успешно переданы
                $order->setIsSent(true);
                $manager->persist($order);
            } else {
                $this->_log($result);
            }
        }


        $manager->flush();

        echo "Успешно. \n";
    }

    /**
     * Логируем ошибку
     */
    private function _log(Order $order, $result) {
        $message = $order->getId() . ' ' . print_r($result, true);
        $this->getContainer()->get('logger')->info($message, true);
    }

    private function _sendOrder(Order $order) {
        $urlTemplate = $this->getContainer()->getParameter('zcpa_api_route_template');

        $repoStream = $this->getContainer()->get('doctrine')->getRepository(Stream::class);

        /** @var Stream $stream */
        $stream = $repoStream->findOneBy(['product'=> $order->getProduct()->getId()]);

        $url = $urlTemplate;

        $url = str_replace('{api_key}', $this->getContainer()->getParameter('zcpa_api_key'), $url);
        $url = str_replace('{ip}', $order->getIp(), $url);
        $url = str_replace('{phone}', $order->getPhone(), $url);
        $url = str_replace('{mark}', $stream->getStreamId(), $url);

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }
}
