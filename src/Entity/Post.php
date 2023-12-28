<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(operations: [
    new GetCollection()
], normalizationContext: ['groups' => ['post']],
    paginationEnabled: false)]
#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['post'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['post'])]
    private ?string $body = null;

    #[ORM\Column(length: 255)]
    #[Groups(['post'])]
    private ?string $title = null;

    #[ORM\ManyToOne(fetch: 'EAGER', inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['post'])]
    private ?User $author = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): void
    {
        $this->body = $body;
    }
}
