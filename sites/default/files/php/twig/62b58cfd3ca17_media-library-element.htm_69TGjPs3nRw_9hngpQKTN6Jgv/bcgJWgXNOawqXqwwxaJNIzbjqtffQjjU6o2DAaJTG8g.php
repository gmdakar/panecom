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

/* modules/contrib/media_library_form_element/templates/media-library-element.html.twig */
class __TwigTemplate_e85e1079c17a09556c788118b8dd2d3644c09be323c1752831ecb107783fa399 extends \Twig\Template
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
        // line 27
        $context["classes"] = [0 => "js-form-item", 1 => "form-item", 2 => "js-form-wrapper", 3 => "form-wrapper"];
        // line 34
        echo "<fieldset";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 34), 34, $this->source), "html", null, true);
        echo ">
  ";
        // line 36
        $context["legend_span_classes"] = [0 => "fieldset-legend", 1 => ((        // line 38
($context["required"] ?? null)) ? ("js-form-required") : ("")), 2 => ((        // line 39
($context["required"] ?? null)) ? ("form-required") : (""))];
        // line 42
        echo "  <legend";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["legend"] ?? null), "attributes", [], "any", false, false, true, 42), 42, $this->source), "html", null, true);
        echo ">
    <span";
        // line 43
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["legend_span"] ?? null), "attributes", [], "any", false, false, true, 43), "addClass", [0 => ($context["legend_span_classes"] ?? null)], "method", false, false, true, 43), 43, $this->source), "html", null, true);
        echo ">";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["legend"] ?? null), "title", [], "any", false, false, true, 43), 43, $this->source), "html", null, true);
        echo "</span>
  </legend>
  <div class=\"fieldset-wrapper\">
    ";
        // line 46
        if (($context["errors"] ?? null)) {
            // line 47
            echo "      <div>
        ";
            // line 48
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["errors"] ?? null), 48, $this->source), "html", null, true);
            echo "
      </div>
    ";
        }
        // line 51
        echo "    ";
        if (($context["prefix"] ?? null)) {
            // line 52
            echo "      <span class=\"field-prefix\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null), 52, $this->source), "html", null, true);
            echo "</span>
    ";
        }
        // line 54
        echo "    ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 54, $this->source), "html", null, true);
        echo "
    ";
        // line 55
        if (($context["suffix"] ?? null)) {
            // line 56
            echo "      <span class=\"field-suffix\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["suffix"] ?? null), 56, $this->source), "html", null, true);
            echo "</span>
    ";
        }
        // line 58
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 58)) {
            // line 59
            echo "      <div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "attributes", [], "any", false, false, true, 59), "addClass", [0 => "description"], "method", false, false, true, 59), 59, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["description"] ?? null), "content", [], "any", false, false, true, 59), 59, $this->source), "html", null, true);
            echo "</div>
    ";
        }
        // line 61
        echo "  </div>
</fieldset>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/media_library_form_element/templates/media-library-element.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  107 => 61,  99 => 59,  96 => 58,  90 => 56,  88 => 55,  83 => 54,  77 => 52,  74 => 51,  68 => 48,  65 => 47,  63 => 46,  55 => 43,  50 => 42,  48 => 39,  47 => 38,  46 => 36,  41 => 34,  39 => 27,);
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Default theme implementation for a fieldset element and its children.
 *
 * Available variables:
 * - attributes: HTML attributes for the <fieldset> element.
 * - errors: (optional) Any errors for this <fieldset> element, may not be set.
 * - required: Boolean indicating whether the <fieldeset> element is required.
 * - legend: The <legend> element containing the following properties:
 *   - title: Title of the <fieldset>, intended for use as the text
       of the <legend>.
 *   - attributes: HTML attributes to apply to the <legend> element.
 * - description: The description element containing the following properties:
 *   - content: The description content of the <fieldset>.
 *   - attributes: HTML attributes to apply to the description container.
 * - children: The rendered child elements of the <fieldset>.
 * - prefix: The content to add before the <fieldset> children.
 * - suffix: The content to add after the <fieldset> children.
 *
 * @see template_preprocess_fieldset()
 *
 * @ingroup themeable
 */
#}
{%
  set classes = [
  'js-form-item',
  'form-item',
  'js-form-wrapper',
  'form-wrapper',
]
%}
<fieldset{{ attributes.addClass(classes) }}>
  {%
    set legend_span_classes = [
    'fieldset-legend',
    required ? 'js-form-required',
    required ? 'form-required',
  ]
  %}
  <legend{{ legend.attributes }}>
    <span{{ legend_span.attributes.addClass(legend_span_classes) }}>{{ legend.title }}</span>
  </legend>
  <div class=\"fieldset-wrapper\">
    {% if errors %}
      <div>
        {{ errors }}
      </div>
    {% endif %}
    {% if prefix %}
      <span class=\"field-prefix\">{{ prefix }}</span>
    {% endif %}
    {{ content }}
    {% if suffix %}
      <span class=\"field-suffix\">{{ suffix }}</span>
    {% endif %}
    {% if description.content %}
      <div{{ description.attributes.addClass('description') }}>{{ description.content }}</div>
    {% endif %}
  </div>
</fieldset>
", "modules/contrib/media_library_form_element/templates/media-library-element.html.twig", "/home/cloudpanel/htdocs/devpanecom/modules/contrib/media_library_form_element/templates/media-library-element.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 27, "if" => 46);
        static $filters = array("escape" => 34);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
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
