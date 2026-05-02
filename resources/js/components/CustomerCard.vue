<template>
    <article class="rounded-2xl border border-sky-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
        <div class="mb-4 flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-sky-100 font-semibold text-sky-700">
                {{ customer.first_name?.[0] }}{{ customer.last_name?.[0] }}
            </div>

            <div>
                <h2 class="font-semibold text-slate-900">
                    {{ customer.first_name }} {{ customer.last_name }}
                </h2>

                <p class="text-sm text-slate-500">
                    {{ customer.company }}
                </p>
            </div>
        </div>

        <div class="space-y-2 text-sm text-slate-600">
            <p>
                <span class="font-medium text-slate-800">Email:</span>
                {{ customer.email }}
            </p>

            <p>
                <span class="font-medium text-slate-800">City:</span>
                {{ customer.city }}
            </p>

            <p>
                <span class="font-medium text-slate-800">IP:</span>
                <span class="font-mono text-xs text-sky-700">
                    {{ customer.ip_address }}
                </span>
            </p>
        </div>

        <a
            v-if="customer.website"
            :href="customer.website"
            target="_blank"
            class="mt-4 inline-block text-sm font-medium text-sky-600 hover:text-sky-800"
        >
            Visit website →
        </a>
    </article>
</template>

<script setup>
defineProps({
    customer: {
        type: Object,
        required: true,
    },
});
</script>
