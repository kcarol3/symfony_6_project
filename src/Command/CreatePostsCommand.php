<?php

namespace App\Command;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(name: 'app:create-posts')]
class CreatePostsCommand extends Command
{
    private EntityManagerInterface $em;
    public function __construct(
        private HttpClientInterface $client, \Doctrine\ORM\EntityManagerInterface $em,
    ) {
        parent::__construct();
        $this->em = $em;
    }

    /**
     * @throws TransportExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Posts have started downloading',
            '============',
        ]);
        $postsResponse = $this->client->request(
            'GET',
            'https://jsonplaceholder.typicode.com/posts'
        );
        $posts = json_decode($postsResponse->getContent(), true);
        $output->writeln([
            'Success download',
            '============',
        ]);

        $output->writeln([
            'Users have started downloading',
            '============',
        ]);
        $usersResponse = $this->client->request(
            'GET',
            'https://jsonplaceholder.typicode.com/users'
        );
        $users = json_decode($usersResponse->getContent(), true);
        $output->writeln([
            'Success download',
            '============',
        ]);

        foreach ($users as  $user){
            if($this->em->getRepository(User::class)->find($user['id']) == null){
                $newUser = new User();
                $fullNameArray = explode(' ', $user['name']);
                $newUser->setName($fullNameArray[0]);
                $newUser->setSurname($fullNameArray[1]);

                $this->em->persist($newUser);
                $this->em->flush();
            }
        }

        foreach ($posts as $post) {
            $newPost = new Post();
            $newPost->setBody($post['body']);
            $newPost->setTitle($post['title']);

            $author = $this->em->getRepository(User::class)->find($post['userId']);
            $newPost->setAuthor($author);

            $this->em->persist($newPost);
            $this->em->flush();
        }
        $output->writeln([
            'Successfully saved',

        ]);

        return Command::SUCCESS;
    }
}