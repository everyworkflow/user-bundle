<?php

namespace EveryWorkflow\UserBundle\Controller;

use EveryWorkflow\CoreBundle\Annotation\EWFRoute;
use EveryWorkflow\CoreBundle\HttpFoundation\EWFResponse;
use EveryWorkflow\UserBundle\Repository\UserRepositoryInterface;
use EveryWorkflow\UserBundle\Security\User\WebserviceUser;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends AbstractController
{
    protected UserRepositoryInterface $userRepository;
    private EWFResponse $response;

    /**
     * UserController constructor.
     */
    public function __construct(UserRepositoryInterface $userRepository, EWFResponse $response)
    {
        $this->userRepository = $userRepository;
        $this->response = $response;
    }

    /**
     * @Route(
     *     path="/register",
     *     priority=10,
     *     name="api_user_register",
     *     methods={"POST"}
     * )
     *
     * @return JsonResponse
     */
    public function register(UserPasswordHasherInterface $passwordEncoder, Request $request)
    {
        $submitData = json_decode($request->getContent(), true);
        $password = $submitData['password'];
        $passwordConfirmation = $submitData['password_confirmation'];

        $errors = [];
        if ($password != $passwordConfirmation) {
            $errors[] = 'Password does not match the password confirmation.';
        }

        if (strlen($password) < 6) {
            $errors[] = 'Password should be at least 6 characters.';
        }

        if (!$errors) {
            $userWebServiceData = new WebserviceUser('durga1@durga.com');
            $submitData['password'] = $passwordEncoder->hashPassword($userWebServiceData, $password);
            unset($submitData['password_confirmation']);
            try {
                $user = $this->userRepository->getNewEntity($submitData);
                $result = $this->userRepository->save($user);
                if ($result->getUpsertedId()) {
                    $user->setData('_id', $result->getUpsertedId());
                }

                return $this->response->respondWithSuccess(
                    sprintf('User %s successfully created', $user->getData('email'))
                );
            } catch (UniqueConstraintViolationException $e) {
                $errors[] = 'The email provided already has an account!';
            } catch (\Exception $e) {
                $errors[] = 'Unable to save new user at this time.';
            }
        }

        return $this->json([
            'errors' => $errors,
        ], 400);
    }

    /**
     * @return JsonResponse
     */
    public function getTokenUser(UserInterface $user, JWTTokenManagerInterface $JWTManager)
    {
        return new JsonResponse(['token' => $JWTManager->create($user)]);
    }

    /**
     * @EWFRoute (api_path="me", name="api_me")
     *
     * @return EWFResponse
     */
    public function profile(): EWFResponse
    {
        return $this->response->setSuccessResponse([
            'user' => $this->getUser()->getEntity()->toArray(),
        ]);
    }
}
