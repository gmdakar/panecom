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

/* modules/contrib/viewfield/templates/viewfield.html.twig */
class __TwigTemplate_ed9da5dbf302e55e66c208420079c4d97de27ec148271464d048b0b596b7f16d extends \Twig\Template
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
        // line 40
        $context["classes"] = [0 => "field", 1 => ("field--name-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 42
($context["field_name"] ?? null), 42, $this->source))), 2 => ("field--type-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 43
($context["field_type"] ?? null), 43, $this->source))), 3 => ("field--label-" . $this->sandbox->ensureToStringAllowed(        // line 44
($context["label_display"] ?? null), 44, $this->source))];
        // line 48
        $context["title_classes"] = [0 => "field__label", 1 => (((        // line 50
($context["label_display"] ?? null) == "visually_hidden")) ? ("visually-hidden") : (""))];
        // line 53
        echo "
<div";
        // line 54
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 54), 54, $this->source), "html", null, true);
        echo ">
  ";
        // line 55
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null), 55, $this->source), "html", null, true);
        echo "
  ";
        // line 56
        if (( !($context["label_hidden"] ?? null) && ($context["label"] ?? null))) {
            // line 57
            echo "    <div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["title_attributes"] ?? null), "addClass", [0 => ($context["title_classes"] ?? null)], "method", false, false, true, 57), 57, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 57, $this->source), "html", null, true);
            echo "</div>
  ";
        }
        // line 59
        echo "  ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null), 59, $this->source), "html", null, true);
        echo "
  ";
        // line 60
        if (($context["multiple"] ?? null)) {
            // line 61
            echo "    <div class=\"field__items\">
  ";
        }
        // line 63
        echo "  ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 64
            echo "    ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["item"], 64, $this->source), "html", null, true);
            echo "
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 66
        echo "  ";
        if (($context["multiple"] ?? null)) {
            // line 67
            echo "    </div>
  ";
        }
        // line 69
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/viewfield/templates/viewfield.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  100 => 69,  96 => 67,  93 => 66,  84 => 64,  79 => 63,  75 => 61,  73 => 60,  68 => 59,  60 => 57,  58 => 56,  54 => 55,  50 => 54,  47 => 53,  45 => 50,  44 => 48,  42 => 44,  41 => 43,  40 => 42,  39 => 40,);
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Default theme implementation for a viewfield
 *
 * To override output, copy the \"viewfield.html.twig\" from the templates directory
 * to your theme's directory and customize it, just like customizing other
 * Drupal templates such as page.html.twig or node.html.twig.
 *
 * Instead of overriding the theming for all fields, you can also just override
 * theming for a subset of fields using
 * @link themeable Theme hook suggestions. @endlink For example,
 * here are some theme hook suggestions that can be used for a field_foo field
 * on an article node type:
 * - viewfield--node--field-foo--article.html.twig
 * - viewfield--node--field-foo.html.twig
 * - viewfield--node--article.html.twig
 * - viewfield--field-foo.html.twig
 * - viewfield--text-with-summary.html.twig
 * - viewfield.html.twig
 *
 * Available variables:
 * - attributes: HTML attributes for the containing element.
 * - label_hidden: Whether to show the field label or not.
 * - title_attributes: HTML attributes for the title.
 * - label: The label for the field.
 * - multiple: TRUE if a field can contain multiple items.
 * - items: List of all the viewfield items.
 * - entity: The entity to which the field belongs.
 * - entity_type: The entity type to which the field belongs.
 * - bundle: The entity bundle to which the field belongs.
 * - field_name: The name of the field.
 * - label_display: The display settings for the label.
 *
 *
 * @see template_preprocess_viewfield()
 */
#}
{%
  set classes = [
    'field',
    'field--name-' ~ field_name|clean_class,
    'field--type-' ~ field_type|clean_class,
    'field--label-' ~ label_display,
  ]
%}
{%
  set title_classes = [
    'field__label',
    label_display == 'visually_hidden' ? 'visually-hidden',
  ]
%}

<div{{ attributes.addClass(classes) }}>
  {{ title_prefix }}
  {% if not label_hidden and label %}
    <div{{ title_attributes.addClass(title_classes) }}>{{ label }}</div>
  {% endif %}
  {{ title_suffix }}
  {% if multiple %}
    <div class=\"field__items\">
  {% endif %}
  {% for item in items %}
    {{ item }}
  {% endfor %}
  {% if multiple %}
    </div>
  {% endif %}
</div>
", "modules/contrib/viewfield/templates/viewfield.html.twig", "/home/cloudpanel/htdocs/devpanecom/modules/contrib/viewfield/templates/viewfield.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 40, "if" => 56, "for" => 63);
        static $filters = array("clean_class" => 42, "escape" => 54);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'for'],
                ['clean_class', 'escape'],
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
