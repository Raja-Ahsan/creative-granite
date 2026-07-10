<div class="overflow-hidden rounded-lg border border-gray-200 bg-[#f5f0ea]">
    <div class="border-b border-gray-200 bg-white px-4 py-3">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.14em] text-gray-700">Live Email Preview</p>
                <p class="mt-0.5 text-xs text-gray-500">Sample data is used for merge tags.</p>
            </div>
            <label class="inline-flex items-center gap-2 text-xs text-gray-600">
                <input type="checkbox" id="preview-use-samples" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" checked>
                Fill sample data
            </label>
        </div>
    </div>

    <div class="p-4">
        <p class="mb-3 text-xs font-medium uppercase tracking-wider text-gray-500">Subject</p>
        <p id="email-preview-subject" class="mb-4 rounded-md border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900">
            Your email subject will appear here
        </p>

        <div class="mx-auto max-w-[600px] overflow-hidden rounded border border-[#e8dfd4] bg-white shadow-sm">
            <div class="bg-[#2a2622] px-8 py-6">
                <p class="text-lg uppercase tracking-[0.12em] text-[#f5f0ea]">Creative Granite &amp; Design</p>
            </div>
            <div
                id="email-preview-body"
                class="px-8 py-8 text-base leading-relaxed text-[#2a2622]"
                style="font-family: Georgia, 'Times New Roman', serif;"
            >
                <p class="text-sm text-gray-400">Start typing in the editor to preview your email.</p>
            </div>
            <div class="border-t border-[#e8dfd4] px-8 py-5 text-xs leading-relaxed text-[#8a8278]">
                This email was sent from Creative Granite &amp; Design.
            </div>
        </div>
    </div>
</div>
