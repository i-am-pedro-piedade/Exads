<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\TvShow;
use App\Repository\TvShowRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TvShowFilterType extends AbstractType
{
    /**
     * @param array<string, string> $options
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /**
 * @var EntityManagerInterface $entityManager
*/
        $entityManager = $options['entity_manager'];
        /**
 * @var TvShowRepository $tvShowRepository
*/
        $tvShowRepository = $entityManager->getRepository(TvShow::class);

        $builder
            ->setMethod('GET')
            ->add(
                'tvShows',
                EntityType::class,
                [
                'label' => false,
                'class' => TvShow::class,
                'placeholder' => 'TV Show',
                'query_builder' => $tvShowRepository->findAllQb(),
                'multiple' => true,
                'required' => false,
                'attr' => [
                    'data-behaviour' => 'advanced-select',
                    'data-placeholder' => 'Filter by show',
                    'class' => 'single-row',
                ],
                ]
            )
            ->add(
                'afterDate',
                DateType::class,
                [
                'required' => false,
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker', 'data-behaviour' => 'datepicker', 'placeholder' => 'Only shows starting after this date'],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => null])->setRequired(['entity_manager']);
    }
}
