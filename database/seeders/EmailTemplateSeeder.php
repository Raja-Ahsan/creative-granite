<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'name' => 'Follow Up',
                'slug' => 'follow-up',
                'subject' => 'Following up — {{customer_name}}',
                'description' => 'Follow up after a customer inquiry or showroom visit.',
                'body' => <<<'HTML'
<p>Hi {{customer_name}},</p>
<p>Thank you for reaching out to Creative Granite. We wanted to follow up on your recent inquiry about {{project_type}}.</p>
<p>{{message}}</p>
<p>If you have any questions or would like to schedule a visit to our showroom, reply to this email or call us at {{phone}}.</p>
<p>Best regards,<br>{{sender_name}}<br>Creative Granite &amp; Design</p>
HTML,
                'sort_order' => 1,
            ],
            [
                'name' => 'Quote Ready',
                'slug' => 'quote-ready',
                'subject' => 'Your estimate is ready — Creative Granite',
                'description' => 'Notify a customer that their quote or estimate is ready.',
                'body' => <<<'HTML'
<p>Hi {{customer_name}},</p>
<p>Your estimate for {{project_type}} is ready.</p>
<p>{{message}}</p>
<p>We are happy to walk you through the details or answer any questions.</p>
<p>Best regards,<br>{{sender_name}}<br>Creative Granite &amp; Design</p>
HTML,
                'sort_order' => 2,
            ],
            [
                'name' => 'Thank You',
                'slug' => 'thank-you',
                'subject' => 'Thank you, {{customer_name}}',
                'description' => 'Send a thank-you note after a project or consultation.',
                'body' => <<<'HTML'
<p>Hi {{customer_name}},</p>
<p>Thank you for choosing Creative Granite. We appreciate the opportunity to work with you on {{project_type}}.</p>
<p>{{message}}</p>
<p>Warm regards,<br>{{sender_name}}<br>Creative Granite &amp; Design</p>
HTML,
                'sort_order' => 3,
            ],
            [
                'name' => 'Appointment Confirmation',
                'slug' => 'appointment-confirmation',
                'subject' => 'Appointment confirmed — {{appointment_date}}',
                'description' => 'Confirm a showroom visit or consultation appointment.',
                'body' => <<<'HTML'
<p>Hi {{customer_name}},</p>
<p>This confirms your appointment with Creative Granite on <strong>{{appointment_date}}</strong>.</p>
<p>{{message}}</p>
<p>Our showroom is located at {{address}}. If you need to reschedule, reply to this email or call {{phone}}.</p>
<p>See you soon,<br>{{sender_name}}<br>Creative Granite &amp; Design</p>
HTML,
                'sort_order' => 4,
            ],
        ];

        foreach ($templates as $template) {
            EmailTemplate::updateOrCreate(
                ['slug' => $template['slug']],
                array_merge($template, ['is_active' => true, 'is_system' => true])
            );
        }
    }
}
