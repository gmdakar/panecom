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

/* modules/contrib/leaflet/templates/leaflet-map.html.twig */
class __TwigTemplate_503eb090409ac63a8fe5531c048b1a583d85a9d9170af01ab879ebb995132ef4 extends \Twig\Template
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
        // line 20
        echo "<div id=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["map_id"] ?? null), 20, $this->source), "html", null, true);
        echo "\" style=\"min-width: 150px; ";
        if ( !twig_test_empty(($context["height"] ?? null))) {
            echo "height: ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["height"] ?? null), 20, $this->source), "html", null, true);
        }
        echo "\"></div>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/leaflet/templates/leaflet-map.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 20,);
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Theme implementation to display a Leaflet map.
 *
 * This creates a placeholder for the map to be injected in.
 *
 * Available variables:
 * - map_id
 * - height
 *
 * Note: min-width is set so that a map will show when \"Inline\" is specified
 * for the associated field label. This may of course be overridden. The default
 * field label style is \"Above\" with a width of 100%.
 *
 * @ingroup themeable
 *
 */
#}
<div id=\"{{ map_id }}\" style=\"min-width: 150px; {% if height is not empty %}height: {{ height }}{% endif %}\"></div>
", "modules/contrib/leaflet/templates/leaflet-map.html.twig", "/home/cloudpanel/htdocs/devpanecom/modules/contrib/leaflet/templates/leaflet-map.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 20);
        static $filters = array("escape" => 20);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
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
