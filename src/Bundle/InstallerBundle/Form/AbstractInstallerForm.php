<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Bundle\InstallerBundle\Form;

use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\Form\AbstractType;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
abstract class AbstractInstallerForm extends AbstractType
{
    /**
     * @var Translator $translator
     */
    protected $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return Translator
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    protected function trans($id, $params = [], $domain = 'symforium', $locale = 'en')
    {
        if ($domain === 'symforium') {
            $id = 'symforium.installer.'.$id;
        }

        return $this->translator->trans($id, $params, $domain, $locale);
    }
}
 