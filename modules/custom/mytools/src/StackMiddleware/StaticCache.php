<?php
namespace Drupal\mytools\StackMiddleware;
 
use Drupal\page_cache\StackMiddleware\PageCache;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Cache\CacheableResponseInterface;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\PageCache\RequestPolicyInterface;
use Drupal\Core\PageCache\ResponsePolicyInterface;
use Drupal\Core\Site\Settings;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\HttpKernelInterface;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\user\Entity\User;
use Drupal\Core\Url;
use Drupal\taxonomy\Entity\Vocabulary;

/**
 * Executes the page caching before the main kernel takes over the request.
 */
class StaticCache extends PageCache
{
  /**
   * {@inheritdoc}
   */
  public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = TRUE) {
    // do special logic here.

    $response = parent::handle($request, $type, $catch);
	
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
		
		if ($url)
		{
			// redirect:
			$response = new RedirectResponse($url->toString());
			//$response->send();
		}
    }

    return $response;	
  }
}