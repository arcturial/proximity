<?php
namespace App\Controller;

use App\Application;
use Arcturial\Kontakt\KontaktClient;
use Arcturial\Kontakt\Resource\Device;
use Symfony\Component\HttpFoundation\Request;

class AccountController
{
    private function getUserService(Application $app)
    {
        return new \App\Service\UserService($app['db'], new \App\Persister);
    }

    private function getAuth(Application $app)
    {
        return new \App\Auth($this->getUserService($app), $app['session']);
    }

	public function overviewAction(Application $app, Request $request)
	{
        $user = $this->getAuth($app)->authenticatedUser();

        $form = $app->form($user)
            ->add('email', \Symfony\Component\Form\Extension\Core\Type\TextType::class, ['label' => 'Email'])
            ->add('password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, ['label' => 'Password'])
            ->add('name', \Symfony\Component\Form\Extension\Core\Type\TextType::class, ['label' => 'Name'])
            ->add('save', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'Update'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            var_dump($user);
            die();
        }

		return $app->render('account/overview.html.twig', [ 'form' => $form->createView() ]);
	}
}