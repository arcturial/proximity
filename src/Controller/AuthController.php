<?php
namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Proximity\User;

class AuthController
{
    private function getUserService(Application $app)
    {
        return new \App\Service\UserService($app['db'], new \App\Persister);
    }

    private function getAuth(Application $app)
    {
        return new \App\Auth($this->getUserService($app), $app['session']);
    }

	public function loginAction(Application $app, Request $request)
	{
        $form = $app->form($data)
            ->add('email', \Symfony\Component\Form\Extension\Core\Type\TextType::class, ['label' => 'Email'])
            ->add('password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, ['label' => 'Password'])
            ->add('login', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'Login', 'attr' => ['class' => 'btn-primary btn-block']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $this->getAuth($app)->authenticate('test@test.com', 'test');
            return $app->redirect('/');
        }

        //$user = new \App\Entity\User;
        //$this->getUserService($app)->create($user);

        return $app->render('auth/login.html.twig', [ 'form' => $form->createView() ]);
	}
}