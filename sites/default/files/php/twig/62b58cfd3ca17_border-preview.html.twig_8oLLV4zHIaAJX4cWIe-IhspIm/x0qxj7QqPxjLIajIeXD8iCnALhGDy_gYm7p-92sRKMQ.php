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

/* modules/contrib/bootstrap_styles/templates/border-preview.html.twig */
class __TwigTemplate_25fe7547eb2a7e7fdb93968a659cd980521e841b91cb407a2e07c8fec479e7a9 extends \Twig\Template
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
        // line 9
        echo "
";
        // line 10
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("bootstrap_styles/plugins_groups.border.border_preview"), "html", null, true);
        echo "

<div data-bs-element=\"bs_preview-box\" id=\"bs-border-preview\">
  ";
        // line 13
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Preview"));
        echo "
</div>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/bootstrap_styles/templates/border-preview.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 13,  42 => 10,  39 => 9,);
    }

    public function getSourceContext()
    {
        return new Source("{#
 /**
  * @file
  * Default theme implementation of border preview box.
  *
  * @ingroup themeable
  */
#}

{{ attach_library('bootstrap_styles/plugins_groups.border.border_preview') }}

<div data-bs-element=\"bs_preview-box\" id=\"bs-border-preview\">
  {{ 'Preview'|t }}
</div>
", "modules/contrib/bootstrap_styles/templates/border-preview.html.twig", "/home/cloudpanel/htdocs/devpanecom/modules/contrib/bootstrap_styles/templates/border-preview.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("escape" => 10, "t" => 13);
        static $functions = array("attach_library" => 10);

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape', 't'],
                ['attach_library']
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
