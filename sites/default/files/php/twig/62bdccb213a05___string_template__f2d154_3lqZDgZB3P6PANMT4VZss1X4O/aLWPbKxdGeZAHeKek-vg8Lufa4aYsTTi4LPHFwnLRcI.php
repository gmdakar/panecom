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

/* __string_template__f2d1541f011cd0e1da3ee4a24386fd9f67747ae73e599c5bfc8801f1c008f016 */
class __TwigTemplate_075b4d40c381240c5472c2dbce4edacadb88f9274bb4896d344f807f054f5bfa extends \Twig\Template
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
        echo "<div class='menu'>
      <ul class='menu-list  ' >
            <li class='menu-item' ><a href='/node/add/document?edit[field_document_organisation][widget][0][target_id]=";
        // line 3
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["field_user_organisation"] ?? null), 3, $this->source), "html", null, true);
        echo "' class=\"mt-button\">Ajouter un document</a></li>
            <li class='menu-item' ><a href='/node/add/evenement?edit[field_evenement_organisation][widget][0][target_id]=";
        // line 4
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["field_user_organisation"] ?? null), 4, $this->source), "html", null, true);
        echo "' class=\"mt-button\">Ajouter un évènement</a></li>
            <li class='menu-item' ><a href='/node/add/projet?edit[field_projet_organisation][widget][0][target_id]=";
        // line 5
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["field_user_organisation"] ?? null), 5, $this->source), "html", null, true);
        echo "' class=\"mt-button\" >Ajouter un projet</a></li>
\t    <li class='menu-item' ><a href='/node/add/article?edit[field_article_organisation][widget][0][target_id]=";
        // line 6
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["field_user_organisation"] ?? null), 6, $this->source), "html", null, true);
        echo "' class=\"mt-button\" >Ajouter une actualité</a></li>
      </ul>
</div>";
    }

    public function getTemplateName()
    {
        return "__string_template__f2d1541f011cd0e1da3ee4a24386fd9f67747ae73e599c5bfc8801f1c008f016";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 6,  51 => 5,  47 => 4,  43 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "__string_template__f2d1541f011cd0e1da3ee4a24386fd9f67747ae73e599c5bfc8801f1c008f016", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("escape" => 3);
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
