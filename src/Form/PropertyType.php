<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description', TextareaType::class,[
                "label"=>"Description"
            ])
            ->add('surface')
            ->add('rooms',null,['label'=>'Pièces'])
            ->add('bedrooms',null,['label'=>'Chambres'])
            ->add('floor',null,['label'=>'Etages'])
            ->add('heat',ChoiceType::class, [
                'label'=>'Chauffage',
                'choices'=>$this->getChoices()
            ])
            ->add('city',null,['label'=>'Ville'])
            ->add('address',null,['label'=>'Adresse'])
            ->add('postal_code',null,['label'=>'Code postal'])
            ->add('sold',null,['label'=>'Vendu?'])
//            ->add('created_at')
            ->add('price',null,['label'=>'Prix'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
//            'translation_domain'=>'forms'
        ]);
    }

    /**
     * Retourne les choix pour un bien en particulier
     * @return array
     */
    private function getChoices(): array
    {
        $choices = Property::HEAT;
        $output=[];
        foreach ($choices as $k =>$v){
            $output[$v]=$k;
        }
        return $output;
    }
}
