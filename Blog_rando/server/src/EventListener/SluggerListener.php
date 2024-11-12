<?php
namespace App\EventListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class SluggerListener
{
    private $slugger;
    private $entityManager;

    public function __construct(SluggerInterface $slugger, EntityManagerInterface $entityManager)
    {
        $this->slugger = $slugger;
        $this->entityManager = $entityManager;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Article) {
            return;
        }

        if (empty($entity->getSlug())) {
            $entity->setSlug($this->generateUniqueSlug($entity->getTitle()));
        }
    }

    private function generateUniqueSlug(string $title): string
    {
        $slug = $this->slugger->slug($title)->lower();
        $originalSlug = $slug;
        $i = 1;

        while ($this->isSlugExists($slug)) {
            $slug = $originalSlug . '-' . $i++;
        }

        return $slug;
    }

    private function isSlugExists(string $slug): bool
    {
        return null !== $this->entityManager->getRepository(Article::class)->findOneBy(['slug' => $slug]);
    }
}
