<?php

    namespace App\Form;

    use App\Entity\Aloite;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class AloiteFormType extends AbstractType{

        public function buildForm(FormBuilderInterface $builder, array $options){
            $builder
                ->add('Aloite', TextType::class, ['label' => 'Aloite'])
                ->add('Aihe', TextType::class, ['label' => 'Aihe'])
                ->add('Kuvaus', TextType::class, ['label' => 'Kuvaus'])
                ->add('Kirjauspaiva', TextType::class, ['label' => 'Kirjauspaiva'])
                ->add('Etunimi', TextType::class, ['label' => 'Etunimi'])
                ->add('Sukunimi', TextType::class, ['label' => 'Sukunimi'])
                ->add('Email', TextType::class, ['label' => 'Email'])
                ->add('save', SubmitType::class, [
                    'label' => 'Talleta',
                    'attr' => ['class' => 'btn btn-info']
                ]);
        }

        public function configureOptions(OptionsResolver $resolver){
            $resolver->setDefaults([
                'data-class' => Aloite::class,
            ]);
        }
    }



?>