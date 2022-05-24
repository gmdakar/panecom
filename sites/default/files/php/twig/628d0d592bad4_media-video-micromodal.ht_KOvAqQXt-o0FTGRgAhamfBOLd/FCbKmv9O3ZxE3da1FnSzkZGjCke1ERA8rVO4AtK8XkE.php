<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/contrib/media_video_micromodal/templates/media-video-micromodal.html.twig */
class __TwigTemplate_06ad5edf0d1e7b23bb0d2b3f85f03a6dd3b1217986257eeb9c09b34169a3581a extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class=\"modal micromodal-slide\" id=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["modal_id"] ?? null), 1, $this->source), "html", null, true);
        echo "\" aria-hidden=\"true\">
  <div class=\"modal__overlay\" tabindex=\"-1\" data-micromodal-close>
    <div class=\"modal__container\" role=\"dialog\" aria-modal=\"true\" aria-labelledby=\"";
        // line 3
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["modal_id"] ?? null), 3, $this->source), "html", null, true);
        echo "-content\">
      <a class=\"modal__btn\" data-micromodal-close aria-label=\"Close this dialog window\">X</a>
      <main class=\"modal__content\" id=\"";
        // line 5
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["modal_id"] ?? null), 5, $this->source), "html", null, true);
        echo "-content\">
        <div class=\"videoWrapper\"><iframe src=\"";
        // line 6
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["iframe_src"] ?? null), 6, $this->source), "html", null, true);
        echo "\" frameborder=\"0\" allowtransparency=\"\" class=\"media-oembed-content\" title=\"Time Value of Money\"></iframe></div>
      </main>
    </div>
  </div>
</div>
<div";
        // line 11
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "attributes", [], "any", false, false, true, 11), "addClass", [0 => "field__item"], "method", false, false, true, 11), 11, $this->source), "html", null, true);
        echo "><a class=\"myButton\" data-micromodal-trigger=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["modal_id"] ?? null), 11, $this->source), "html", null, true);
        echo "\">";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["linked_item"] ?? null), 11, $this->source), "html", null, true);
        echo "</a></div>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/media_video_micromodal/templates/media-video-micromodal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 11,  54 => 6,  50 => 5,  45 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"modal micromodal-slide\" id=\"{{ modal_id }}\" aria-hidden=\"true\">
  <div class=\"modal__overlay\" tabindex=\"-1\" data-micromodal-close>
    <div class=\"modal__container\" role=\"dialog\" aria-modal=\"true\" aria-labelledby=\"{{ modal_id }}-content\">
      <a class=\"modal__btn\" data-micromodal-close aria-label=\"Close this dialog window\">X</a>
      <main class=\"modal__content\" id=\"{{ modal_id }}-content\">
        <div class=\"videoWrapper\"><iframe src=\"{{ iframe_src }}\" frameborder=\"0\" allowtransparency=\"\" class=\"media-oembed-content\" title=\"Time Value of Money\"></iframe></div>
      </main>
    </div>
  </div>
</div>
<div{{ item.attributes.addClass('field__item') }}><a class=\"myButton\" data-micromodal-trigger=\"{{ modal_id }}\">{{ linked_item }}</a></div>
", "modules/contrib/media_video_micromodal/templates/media-video-micromodal.html.twig", "/home/cloudpanel/htdocs/devpanecom/modules/contrib/media_video_micromodal/templates/media-video-micromodal.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("escape" => 1);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
