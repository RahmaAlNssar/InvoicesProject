<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
$permissions = [
'الفواتير',
'قائمة الفواتير',
'الفواتير المدفوعة',
'الفواتير المدفوعة جزئيا',
'الفواتير الغير مدفوعة',
'أرشيف الفواتير',
'التقارير',
'تقرير الفواتير',
'تقرير العملاء',
'المستخدمين',
'قائمة المستخدمين',
'صلاحيات المستخدمين',
'الاعدادات',
'المنتجات',
'الأقسام',

'إضافة فاتورة',
'حذف فاتورة',
'تصدير ملف أكسل',
'تغيير حالة الدفع',
'تعديل الفاتورة',
'اضافة مرفق',
'حذف مرفق',

'اضافة مستخدم',
'تعديل مستخدم',
'حذف مستخدم',

'عرض صلاحية',
'اضافة صلاحية',
'تعديل صلاحية',
'حذف صلاحية',

'اضافة منتج',
'تعديل منتج',
'حذف منتج',

'اضافة قسم',
'تعديل قسم',
'حذف قسم',





];
foreach ($permissions as $permission) {
Permission::create(['name' => $permission]);
}
}
}
