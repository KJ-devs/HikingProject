<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $isVerified = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $verificationToken = null;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Article::class)]
    private Collection $articles;

    #[ORM\ManyToMany(targetEntity: Messages::class, mappedBy: 'user_id')]
    private Collection $messages;

    #[ORM\ManyToMany(targetEntity: Followers::class, mappedBy: 'user_id')]
    private Collection $followers;

    #[ORM\OneToOne(mappedBy: 'user_id', cascade: ['persist', 'remove'])]
    private ?UserDetails $userDetails = null;

    /**
     * @var Collection<int, PasswordResetRequest>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: PasswordResetRequest::class)]
    private Collection $passwordResetRequests;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->followers = new ArrayCollection();
        $this->passwordResetRequests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }



    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getIsVerified(): bool
    {
        return $this->isVerified;
    }


    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getVerificationToken(): ?string
    {
        return $this->verificationToken;
    }

    public function setVerificationToken(?string $verificationToken): static
    {
        $this->verificationToken = $verificationToken;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setUser($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getUser() === $this) {
                $article->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }


    // public function removeMessage(Messages $message): static
    // {
    //     if ($this->messages->removeElement($message)) {
    //         $message->removeUserId($this);
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, Followers>
     */
    public function getFollowers(): Collection
    {
        return $this->followers;
    }

    public function addFollower(Followers $follower): static
    {
        if (!$this->followers->contains($follower)) {
            $this->followers->add($follower);
            $follower->addUserId($this);
        }

        return $this;
    }

    public function removeFollower(Followers $follower): static
    {
        if ($this->followers->removeElement($follower)) {
            $follower->removeUserId($this);
        }

        return $this;
    }

    public function getUserDetails(): ?UserDetails
    {
        return $this->userDetails;
    }

    public function setUserDetails(UserDetails $userDetails): static
    {
        // set the owning side of the relation if necessary
        if ($userDetails->getUserId() !== $this) {
            $userDetails->setUserId($this);
        }

        $this->userDetails = $userDetails;

        return $this;
    }

    /**
     * @return Collection<int, PasswordResetRequest>
     */
    public function getPasswordResetRequests(): Collection
    {
        return $this->passwordResetRequests;
    }

    public function addPasswordResetRequest(PasswordResetRequest $passwordResetRequest): static
    {
        if (!$this->passwordResetRequests->contains($passwordResetRequest)) {
            $this->passwordResetRequests->add($passwordResetRequest);
            $passwordResetRequest->setUser($this);
        }

        return $this;
    }

    public function removePasswordResetRequest(PasswordResetRequest $passwordResetRequest): static
    {
        if ($this->passwordResetRequests->removeElement($passwordResetRequest)) {
            // set the owning side to null (unless already changed)
            if ($passwordResetRequest->getUser() === $this) {
                $passwordResetRequest->setUser(null);
            }
        }

        return $this;
    }
}
