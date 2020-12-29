<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Product;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ProductController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Product(), function (Grid $grid) {
            // 设置表单提示值
            $grid->quickSearch('title')->placeholder('搜索...');
            $grid->column('id')->sortable();
            $grid->column('title','商品名称');
            $grid->column('image','封面图')->image('http://shop.lucaijiameng.cn/storage/',100, 100);
            $grid->column('on_sale','是否上架')->display(function ($released){
                return $released ? '是':'否';
            });
//            $grid->column('description');
            $grid->column('price','价格');
            $grid->column('rating');
            $grid->column('review_count');
            $grid->column('sold_count');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('title','商品名称');
                $filter->between('created_at', '创建时间')->datetime();
                $filter->between('updated_at', '更新时间')->datetime();
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Product(), function (Show $show) {
            $show->field('id');
            $show->field('description');
            $show->field('image');
            $show->field('on_sale');
            $show->field('price');
            $show->field('rating');
            $show->field('review_count');
            $show->field('sold_count');
            $show->field('title');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        // 这里需要显示地指定关联关系
        $builder = Product::with('skus');
        return Form::make($builder, function (Form $form) {
            // 创建一个输入框，第一个参数 title 是模型的字段名，第二个参数是该字段描述
            $form->display('id');
            $form->text('title', '商品名称')->rules('required');

            // 创建一个选择图片的框
            $form->image('image', '封面图片')->rules('required|image');

            // 创建一个富文本编辑器
            $form->editor('description', '商品描述')->rules('required');
            //价格的默认值
            $form->hidden('price');
            // 创建一组单选框
            $form->radio('on_sale', '上架')->options(['1' => '是', '0'=> '否'])->default('0');

            // 直接添加一对多的关联模型
            $form->hasMany('skus','SKU 列表', function (Form\NestedForm $form) {
                $form->text('title', 'SKU 名称')->rules('required');
                $form->text('description', 'SKU 描述')->rules('required');
                $form->text('price', '单价')->rules('required|numeric|min:0.01');
                $form->text('stock', '剩余库存')->rules('required|integer|min:0');
            });

            $form->footer(function ($footer) {

                // 去掉`查看`checkbox
                $footer->disableViewCheck();

                // 去掉`继续编辑`checkbox
                $footer->disableEditingCheck();

                // 去掉`继续创建`checkbox
                $footer->disableCreatingCheck();
            });



            // 定义事件回调，当模型即将保存时会触发这个回调
            $form->saving(function (Form $form) {
                $form->price = collect($form->input('skus'))->where(Form::REMOVE_FLAG_NAME, 0)->min('price') ?: 0;
            });
        });
    }
}
