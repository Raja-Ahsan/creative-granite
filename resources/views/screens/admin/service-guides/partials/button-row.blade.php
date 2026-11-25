<div class="grid grid-cols-1 gap-4 rounded-lg border border-gray-200 p-4 lg:grid-cols-4" data-row>
    <x-admin.input label="Label" :name="$prefix.'['.$i.'][label]'" :value="$row['label'] ?? ''" />
    <x-admin.input label="URL / Link" :name="$prefix.'['.$i.'][url]'" :value="$row['url'] ?? ''" />
    <x-admin.input label="Sort" :name="$prefix.'['.$i.'][sort_order]'" type="number" :value="$row['sort_order'] ?? $i" />
    <x-admin.checkbox label="Active" :name="$prefix.'['.$i.'][is_active]'" :checked="!empty($row['is_active'])" />
</div>
