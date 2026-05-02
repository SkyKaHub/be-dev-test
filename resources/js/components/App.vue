<script>
import { defineComponent, onMounted } from 'vue'
import { useCustomerStore } from '../stores/customerStore'
import CustomerCard from '@/components/CustomerCard.vue'

export default defineComponent({
    components: {
        CustomerCard
    },

    setup() {

        const customerStore = useCustomerStore()

        const loadCustomers = (page = 1) => {
            customerStore.fetchCustomers(page)
        }

        onMounted(() => {
            loadCustomers()
        })

        return {
            customerStore,
            loadCustomers
        }
    }
})
</script>

<template>
    <main class="min-h-screen bg-slate-50 px-6 py-10">

        <!-- FULLSCREEN LOADER -->

        <div
            v-if="customerStore.isLoading"
            class="fixed inset-0 z-50 flex items-center justify-center bg-white/80 backdrop-blur-sm"
        >
            <div class="flex flex-col items-center gap-4">
                <div
                    class="h-14 w-14 animate-spin rounded-full border-4 border-sky-500 border-t-transparent"
                ></div>

                <p class="text-sm font-medium text-sky-700">
                    Loading customers...
                </p>
            </div>
        </div>

        <section class="mx-auto max-w-7xl">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-900">
                    Customers
                </h1>

                <p class="mt-2 text-slate-500">
                    Customer data imported from CSV file.
                </p>
            </div>

            <!-- ERROR -->

            <div
                v-if="customerStore.error"
                class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"
            >
                {{ customerStore.error }}
            </div>

            <!-- GRID -->

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                <CustomerCard
                    v-for="customer in customerStore.customers"
                    :key="customer.id"
                    :customer="customer"
                />

            </div>

            <!-- PAGINATION -->

            <div class="mt-10 flex items-center justify-center gap-4">

                <button
                    class="rounded-lg border border-sky-200 bg-white px-4 py-2 text-sm font-medium text-sky-700 shadow-sm transition hover:bg-sky-50 disabled:opacity-40"
                    :disabled="customerStore.currentPage <= 1 || customerStore.isLoading"
                    @click="loadCustomers(customerStore.currentPage - 1)"
                >
                    Previous
                </button>

                <span class="text-sm font-medium text-slate-600">
                    Page
                    <span class="text-sky-700">{{ customerStore.currentPage }}</span>
                    of
                    <span class="text-sky-700">{{ customerStore.lastPage }}</span>
                </span>

                <button
                    class="rounded-lg border border-sky-200 bg-white px-4 py-2 text-sm font-medium text-sky-700 shadow-sm transition hover:bg-sky-50 disabled:opacity-40"
                    :disabled="customerStore.currentPage >= customerStore.lastPage || customerStore.isLoading"
                    @click="loadCustomers(customerStore.currentPage + 1)"
                >
                    Next
                </button>

            </div>

        </section>

    </main>
</template>
