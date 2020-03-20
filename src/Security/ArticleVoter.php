<?php


namespace App\Security;


use App\Entity\Article;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class ArticleVoter extends Voter
{
    private $security;

    public function  __construct(Security $security)
    {
        $this->security  = $security;
    }

    const VIEW = 'view';
    const EDIT = 'edit';
    /**
     * @inheritDoc
     */
    protected function supports(string $attribute, $subject)
    {
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }

        if(!$subject instanceof Article){
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return true;
        }

        /** @var Article $article */
        $article = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($article, $user);
            case self::EDIT:
                return $this->canEdit($article, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Article $article, User $user)
    {
        // if they can edit, they can view
        if ($this->canEdit($article, $user)) {
            return true;
        }

        // the Post object could have, for example, a method isPrivate()
        // that checks a boolean $private property
        return !$article->isPrivate();
    }

    private function canEdit(Article $article, User $user)
    {
        // this assumes that the data object has a getOwner() method
        // to get the entity of the user who owns this data object
        return $user->getAlias() === $article->getAuthor();
    }
}