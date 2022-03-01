<?php

namespace Drupal\mytools\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\user\Entity\User;
use Drupal\Core\Url;
use Drupal\taxonomy\Entity\Vocabulary;

/**
 * Class DefaultSubscriber.
 */
class DefaultSubscriber implements EventSubscriberInterface {

  /**
   * Constructs a new DefaultSubscriber object.
   */
  public function __construct() {

  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events['kernel.request'] = ['kernelRequest'];

    return $events;
  }

  /**
   * This method is called when the kernel.request is dispatched.
   * Objectif: Rediriger les terms taxonmy path du genre "/taxonomy_term/term/X" vers une views donnée
   * @param \Symfony\Component\EventDispatcher\Event $event
   *   The dispatched event.
   */
  public function kernelRequest(Event $event) {
	
	$request = $event->getRequest();
    $route_name = $request->attributes->get('_route');
    
    if ($route_name == 'entity.taxonomy_term.canonical')  //terms taxonomy path only
	{
		
		// Create the destination URL, such as:
		$url = '';
		$term_id = substr(\Drupal::service('path.current')->getPath(), 15); // ex. for "/taxonomy_term/term/X"; return X
		$term = \Drupal::entityTypeManager()->getStorage("taxonomy_term")->load($term_id);
		
		if ($term->bundle() == 'date') 
			$url = Url::fromRoute('view.agenda.page_1', ['field_date_target_id[]' => $term ->id()]);
		elseif ($term->bundle() == 'horaires') 
			$url = Url::fromRoute('view.agenda.page_1', ['field_horaire_target_id[]' => $term ->id()]);
		elseif ($term->bundle() == 'salle') 
			$url = Url::fromRoute('view.agenda.page_1', ['field_salle_target_id[]' => $term ->id()]);
		elseif ($term->bundle() == 'legende') 
			$url = Url::fromRoute('view.agenda.page_1', ['field_legende_target_id[]' => $term ->id()]);
		elseif ($term->bundle() == 'motscles') 
			$url = Url::fromRoute('view.agenda.page_1', ['field_mot_s_cle_s__target_id[]' => $term ->id()]);

		// create redirect:
		$response = new RedirectResponse($url->toString());
		$response->send();
    }
  }

}
