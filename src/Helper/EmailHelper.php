<?php
namespace App\Helper;

use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Mailer\MailerInterface;

class EmailHelper 
{
    private $params; 
    private $logger;
    private $mailer;
    
    public function __construct(ContainerBagInterface $params, MailerInterface  $mailer, LoggerInterface $logger)
    {
        // $this->approverRepository = $approverRepository;
        $this->logger = $logger;
        $this->mailer = $mailer;
        $this->params = $params;
    }
   
    public static function mail( $performer, $formData, $message, $url)
    {

        $data = array();
        // dd($performer->getUserInfo()->getEmail());
        array_push($data, ['name' => $formData->getName()]);
        array_push($data, ['weight' => $formData->getWeight()]);
        // array_push($data, ['domainName' => $formData->getDomainName()]);

        $maillermessage = (new TemplatedEmail())
            ->from('tadessetamirat170@gmail.com')
            ->to($performer->getUserInfo()->getEmail())
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->htmlTemplate(
                'page/mail.html.twig'
            )->context([
                'Name' => $formData->getName(),
                'Weight' => $formData->getWeight(),
                // 'domainName' => $formData->getDomainName(),
                'message' => $message,
                'url' => $url
            ]);

        $state = $this->mailer->send($maillermessage);

        // return dd($state);

        $this->logger->info('email sent' . $this->getUser()->getUserInfo()->getEmail());
        $this->addFlash('success', 'Email sent');

        return $this->redirectToRoute('task_assign_new');
    }
}