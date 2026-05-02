import { defineStore } from 'pinia';

export const useCustomerStore = defineStore('customerStore', {
    state: () => ({
        customers: [],
        currentPage: 1,
        lastPage: 1,
        isLoading: false,
        error: null,
    }),

    actions: {
        async fetchCustomers(page = 1) {
            this.isLoading = true;
            this.error = null;

            try {
                const response = await fetch(`/api/customers?page=${page}`);

                if (!response.ok) {
                    throw new Error('Failed to load customers');
                }

                const data = await response.json();

                this.customers = data.data;
                this.currentPage = data.current_page;
                this.lastPage = data.last_page;
            } catch (error) {
                this.error = error.message;
            } finally {
                this.isLoading = false;
            }
        },
    },
});
