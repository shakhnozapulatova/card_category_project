<?php

namespace App\Forms;

use App\Models\Category;
use App\Services\HierarchicalFormatter;
use Saodat\FormBase\Contracts\FormBuilderInterface;

class CategoryForm extends AbstractForm
{
    /**
     * @var HierarchicalFormatter
     */
    private $hierarchicalFormatter;

    public function __construct(FormBuilderInterface $formBuilder)
    {
        $this->hierarchicalFormatter = new HierarchicalFormatter;
        parent::__construct($formBuilder);
    }

    protected function buildForm()
    {
        $this->formBuilder
            ->add('text', 'name', 'Наименование',
                [
                    'validationRule' => 'required',
                    'attributes' => [
                        'outlined' => true,
                        'cols' => 12
                    ],
                ]);


        $this->formBuilder->add('treeselect', 'parent_id', 'Родительская категория',
            [
                'options' => $this->hierarchicalFormatter->formatRecursively(Category::all()->toArray()),
                'placeholder' => 'Родительская категория',
                'attributes' => [
                    'outlined' => true,
                    'cols' => 12
                ],
            ]);

        $this->formBuilder
            ->add('number', 'order', 'Порядок',
                [
                    'attributes' => [
                        'outlined' => true,
                        'cols' => 12
                    ],
                ]);
    }

    public function fill(Category $category)
    {
        foreach ($this->formBuilder->getFields() as $field) {
            $field->setValue($category->{$field->getName()});
        }

        return $this;
    }
}
