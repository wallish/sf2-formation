<?php

namespace ESGI\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProposePostType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('title')
			->add('body')
			->add('category','entity', array('class' => 'ESGIBlogBundle:Category','property' => 'name'))
		;
	}

	public function getName()
	{
		return 'proposeposttype';
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'ESGI\BlogBundle\Entity\Post',
		));
	}

}
