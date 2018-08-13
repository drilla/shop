<?php

namespace AppBundle\Command;

use AppBundle\Entity\Order;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\Client;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Router;

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
        $orders = $repo->createQueryBuilder('o')->where('o.is_sent <> '. Order::IS_SENT)->getQuery()->getResult();

        foreach ($orders as $order) {
            $result = $this->_sendOrder($order);

            if ($result) {
                $order->setIsSent(true);
                $manager->persist($order);
            } else {
                $this->_log('');
            }
        }
        //засылаем

        //помечаем те, которые успешно переданы

        echo "Отправляем лид...";
        echo "Успешно. \n";
    }

    /**
     * Логируем ошибку
     */
    private function _log(string $string) {
        //todo
    }

    private function _sendOrder(Order $order) {

        $router = $this->getContainer()->get('router');
        $context = $router->getContext();
        $context->setHost('example.com');
        $context->setScheme('https');
        $context->setBaseUrl('my/path');

        $urlTemplate = $this->getContainer()->getParameter('zcpa_api_route_template');

        $url = $urlTemplate;

        $url = str_replace('{api_key}', $this->getContainer()->getParameter('zcpa_api_key'), $url);

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }
}
