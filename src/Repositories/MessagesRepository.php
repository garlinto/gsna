<?php
/**
 * gsna/src/Repositories/MessagesRepository.php
 */
namespace gsna\src\Repositories;

use Doctrine\ORM\EntityRepository,
		Doctrine\ORM\Mapping as ORM;

class MessagesRepository extends EntityRepository
{

	public function getMessagesToPost($postId) {
		$qb = $this->_em->createQueryBuilder();
		try {
			$qb
				->select('m')
   			->from('gsna\src\Entities\Messages', 'm')
   			->where('m.postId = ?1')
   			->andWhere('m.pushedToCloud = ?2')
   			->setParameter(1, $postId)
   			->setParameter(2, 'false');
   	
   		return $qb->getQuery()->getResult();
   	} catch (\Exception $e) {
   		echo "Exception at line " . $e->getLine() . " in " . $e->getFile() . ":\n\t" . $e->getMessage();
   	}
	}

}