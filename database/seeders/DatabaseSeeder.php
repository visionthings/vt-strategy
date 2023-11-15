<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\About;
use App\Models\Admin;
use App\Models\Basic;
use App\Models\ConsultationMsg;
use App\Models\Customer;
use App\Models\Governance;
use App\Models\Privacy;
use App\Models\Privreturn;
use App\Models\Term;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //**************************************************************** */
           Admin::create([
            'first_name'=>'Eng-Hatan',
            'last_name'=>'Hassan',
            'email'=>'enghatanhassan@gmail.com',
            'password'=>Hash::make('password'),
            'phone'=>'01012354756',
            'status'=>'super_admin',
           ]); 
        //**************************************************************** */
        $basicData = Basic::create([
            'name'=>'رؤية الأشياء',
            'description'=>'للاستشارات الاستراتيجية والحوكمة',
            'phone'=>'0096123456789',
            'whatsapp'=>null,
            'email'=>'info@visionstratgy.com',
            'address'=>'المملكة العربية السعودية',
            'facebook'=>null,
            'instagram'=>null,
            'snapchat'=>null,
            'linkedin'=>null,
            'twitter'=>null,
        ]);
        $basicData->addMediaFromUrl('https://i.ibb.co/YRmsnGF/Newslo-en.png')
                    ->usingName('Content images')
                    ->toMediaCollection('logo');

        $basicData->addMediaFromUrl('https://i.ibb.co/gMJmXSn/new.png')
                    ->usingName('Content images')
                    ->toMediaCollection('icon');            
 
        //**************************************************************** */
        Governance::create([
            'section_description'=>'هي خدمة تقدمها شركة استشارية متخصصة في مجال الحوكمة والاستشارات، بهدف شرح مفهوم الحوكمة للشركات وأهمية تطبيقها.',
            'description_one'=>'رفع مستوى الوعي بمفهوم الحوكمة بين الشركات.',
            'description_two'=>'توضيح أهمية تطبيق الحوكمة للشركات.',
            'description_three'=>'تقديم إرشادات وتوجيهات حول كيفية تطبيق الحوكمة.',
            'status'=>'active'
        ]);                    
        //**************************************************************** */
        ConsultationMsg::create([
            'consultation_msg'=>'هي خدمة تقدمها شركة استشارية متخصصة في مجال الحوكمة والاستشارات، بهدف شرح مفهوم الحوكمة للشركات وأهمية تطبيقها.'
        ]);
        

        // $firstCustomer =  Customer::create([
        //     'name'=>'م هتان حسن',
        //     'rate'=>5,
        //     'job_name'=>'رئيس مجلس ادارة شركة رؤية الاشياء ',
        //     'comment'=>'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق. إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.',
        // ]);
        // $firstCustomer->addMediaFromUrl('https://www7.0zz0.com/2023/10/12/09/639835057.png')
        //           ->usingName('Customer images')
        //           ->toMediaCollection('customer');  
                  
        // $secondCustomer =  Customer::create([
        //     'name'=>'م هتان حسن',
        //     'rate'=>4,
        //     'job_name'=>'رئيس مجلس ادارة شركة رؤية الاشياء ',
        //     'comment'=>'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق. إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.',
        // ]);
        // $secondCustomer->addMediaFromUrl('https://www7.0zz0.com/2023/10/12/09/639835057.png')
        //           ->usingName('Customer images')
        //           ->toMediaCollection('customer');  
        // $theerdCustomer =  Customer::create([
        //     'name'=>'م هتان حسن',
        //     'rate'=>3,
        //     'job_name'=>'رئيس مجلس ادارة شركة رؤية الاشياء ',
        //     'comment'=>'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق. إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.',
        //     ]);
        // $theerdCustomer->addMediaFromUrl('https://www7.0zz0.com/2023/10/12/09/639835057.png')
        //         ->usingName('Customer images')
        //         ->toMediaCollection('customer'); 

       //**************************************************************** */
       $about = About::create([
                'short_text'=>'رؤية الأشياء للاستشارات الاستراتيجية والحوكمة',
                'content'=>'رؤية الأشياء للاستشارات الاستراتيجية والحوكمة هي شركة استشارية رائدة في المملكة العربية السعودية، تأسست عام 2023، وتقدم خدمات لمساعدة الشركات في تطوير الاستراتيجية والحوكمة لقيادة الشركات أو الادارات العليا. تقع الشركة في مدينة جدة، وتضم فريقًا من المستشارين ذوي الخبرة والمهارات المتخصصة في مجال الاستشارات الاستراتيجية والحوكمة و الالتزام.'
            ]);
       $about->addMediaFromUrl('https://i.ibb.co/ZN6J0HC/enghattan.png')
             ->usingName('About image')
             ->toMediaCollection('about');  
        //**************************************************************** */
        Privacy::create([
            'content'=>'ما هي سياسة الخصوصية الخاصة بالشركة؟',
        ]);
       //**************************************************************** */

        Term::create([
            'content'=>'شروط وأحكام موقع رؤية الأشياء للاستشارات الاستراتيجية والحوكمة',
        ]);

       //**************************************************************** */
        Privreturn::create([
            'content'=>'ما هي سياسة الاسترجاع؟'
        ]);

       //**************************************************************** */

    }
}
