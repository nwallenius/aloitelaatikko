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
                ->add('aihe', TextType::class, ['label' => 'Aihe', 'attr' => ['class' => 'form-control']])
                ->add('kuvaus', TextType::class, ['label' => 'Kuvaus', 'attr' => ['class' => 'form-control']])
                ->add('kirjauspaiva', TextType::class, ['label' => 'Kirjauspaiva', 'attr' => ['class' => 'form-control']])
                ->add('etunimi', TextType::class, ['label' => 'Etunimi', 'attr' => ['class' => 'form-control']])
                ->add('sukunimi', TextType::class, ['label' => 'Sukunimi', 'attr' => ['class' => 'form-control']])
                ->add('email', TextType::class, ['label' => 'Email', 'attr' => ['class' => 'form-control']])
                ->add('save', SubmitType::class, [
                    'label' => 'Talleta',
                    'attr' => ['class' => 'talleta btn btn-lg btn-warning btn-block']
                ]);
        }

        public function configureOptions(OptionsResolver $resolver){
            $resolver->setDefaults([
                'data-class' => Aloite::class,
            ]);
        }
    }



?>