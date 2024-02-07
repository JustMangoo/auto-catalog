<template>
    <AuthenticatedLayout>
        <Head title="Auto" />
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Auto
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-[90rem] sm:px-6 lg:px-8">
                <div class="flex justify-between mb-6">
                    <div class="flex gap-2">
                        <TextInput
                            v-model="filters.autonr"
                            placeholder="Meklēt pēc reģ. num"
                            autocomplete="off"
                            maxlength="20"
                        />
                        <select
                            v-model.number="filters.autogads"
                            class="z-50 block h-full border-gray-300 rounded-md shadow-sm shadow-lg dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                        >
                            <option value="" disabled hidden>
                                Meklēt pēc gada
                            </option>
                            <option
                                v-for="year in getYearsRange()"
                                :key="year"
                                :value="year"
                            >
                                {{ year }}
                            </option>
                        </select>
                        <select
                            v-model="filters.marka"
                            class="z-50 block w-full border-gray-300 rounded-md shadow-sm shadow-lg dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                        >
                            <option value="" disabled hidden>
                                Meklēt pēc markas
                            </option>
                            <option
                                v-for="marka in markas"
                                :key="marka.marka_id"
                                :value="marka.nosaukums"
                                class="p-2"
                            >
                                {{ marka.nosaukums }}
                            </option>
                        </select>
                        <PrimaryButton @click="applyFilters"
                            >Meklēt</PrimaryButton
                        >
                        <PrimaryButton @click="resetFilters"
                            >Notīrīt</PrimaryButton
                        >
                    </div>

                    <Link :href="route('auto.create')">
                        <PrimaryButton>
                            Pievieno Auto
                            <img
                                src="../../../assets/icons/plus.svg"
                                alt="plus-icon"
                                class="h-4"
                            />
                        </PrimaryButton>
                    </Link>
                </div>

                <div
                    class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg"
                >
                    <table class="w-full table-auto">
                        <thead class="border-b border-gray-600">
                            <tr>
                                <th
                                    @click="sort('autonr')"
                                    class="p-3 text-left text-white cursor-pointer"
                                >
                                    Reģistrācijas num.
                                    <img
                                        src="../../../assets/icons/sort.svg"
                                        alt="sort-icon"
                                        class="inline h-4"
                                    />
                                </th>
                                <th
                                    @click="sort('autogads')"
                                    class="p-3 text-left text-white cursor-pointer"
                                >
                                    Izlaiduma gads
                                    <img
                                        src="../../../assets/icons/sort.svg"
                                        alt="sort-icon"
                                        class="inline h-4"
                                    />
                                </th>
                                <th
                                    @click="sort('marka_id')"
                                    class="p-3 text-left text-white cursor-pointer"
                                >
                                    Marka
                                    <img
                                        src="../../../assets/icons/sort.svg"
                                        alt="sort-icon"
                                        class="inline h-4"
                                    />
                                </th>
                                <th
                                    @click="sort('motors_id')"
                                    class="p-3 text-left text-white cursor-pointer"
                                >
                                    Motora tips
                                    <img
                                        src="../../../assets/icons/sort.svg"
                                        alt="sort-icon"
                                        class="inline h-4"
                                    />
                                </th>
                                <th
                                    @click="sort('motoratilpums')"
                                    class="p-3 text-left text-white cursor-pointer"
                                >
                                    Motora tilpums
                                    <img
                                        src="../../../assets/icons/sort.svg"
                                        alt="sort-icon"
                                        class="inline h-4"
                                    />
                                </th>
                                <th
                                    @click="sort('pilnamasa')"
                                    class="p-3 text-left text-white cursor-pointer"
                                >
                                    Pilna masa kg
                                    <img
                                        src="../../../assets/icons/sort.svg"
                                        alt="sort-icon"
                                        class="inline h-4"
                                    />
                                </th>
                                <th
                                    @click="sort('pasmasa')"
                                    class="p-3 text-left text-white cursor-pointer"
                                >
                                    Pašmasa kg
                                    <img
                                        src="../../../assets/icons/sort.svg"
                                        alt="sort-icon"
                                        class="inline h-4"
                                    />
                                </th>
                                <th
                                    @click="sort('piedzina_id')"
                                    class="p-3 text-left text-white cursor-pointer"
                                >
                                    Piedziņas tips
                                    <img
                                        src="../../../assets/icons/sort.svg"
                                        alt="sort-icon"
                                        class="inline h-4"
                                    />
                                </th>
                                <th class="p-3 text-white"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="auto in auto.data" :key="auto.auto_id">
                                <td class="px-4 py-2 text-white">
                                    {{ auto.autonr }}
                                </td>
                                <td class="px-4 py-2 text-white">
                                    {{ auto.autogads }}
                                </td>
                                <td class="px-4 py-2 text-white">
                                    {{ auto.marka.nosaukums }}
                                </td>
                                <td class="px-4 py-2 text-white">
                                    {{ auto.motors.nosaukums }}
                                </td>
                                <!-- Assuming motors relation -->
                                <td class="px-4 py-2 text-white">
                                    {{ auto.motoratilpums }}
                                </td>
                                <td class="px-4 py-2 text-white">
                                    {{ auto.pilnamasa }}
                                </td>
                                <td class="px-4 py-2 text-white">
                                    {{ auto.pasmasa }}
                                </td>
                                <td class="px-4 py-2 text-white">
                                    {{ auto.piedzina.nosaukums }}
                                </td>
                                <!-- Assuming piedzina relation -->
                                <td
                                    class="px-4 py-2 space-x-4 text-center text-right"
                                >
                                    <Link
                                        :href="route('auto.edit', auto.auto_id)"
                                    >
                                        <PrimaryButton>
                                            <img
                                                src="../../../assets/icons/pen-square.svg"
                                                alt="edit-icon"
                                                class="h-5"
                                            />
                                        </PrimaryButton>
                                    </Link>
                                    <PrimaryButton @click="deleteAuto(auto)">
                                        <img
                                            src="../../../assets/icons/trash.svg"
                                            alt="delete-icon"
                                            class="h-5"
                                        />
                                    </PrimaryButton>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-6">
                    <PrimaryButton @click="exportToExcel"
                        >Exportēt uz Excel</PrimaryButton
                    >

                    <Link v-if="auto.prev_page_url" :href="auto.prev_page_url"
                        >Previous</Link
                    >

                    <Link v-if="auto.next_page_url" :href="auto.next_page_url"
                        >Next</Link
                    >
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        PrimaryButton,
        InputError,
        TextInput,
    },
    props: {
        markas: Array,
        auto: Object,
    },
    data() {
        return {
            form: useForm({}),
            filters: {
                autonr: "",
                autogads: "",
                marka: "",
            },
            sortKey: "", // You can sort by any key
            sortOrder: "asc", // or 'desc'
        };
    },
    methods: {
        exportToExcel() {
            window.location.href = route("autos.export");
        },
        deleteAuto(auto) {
            this.form.delete(route("auto.destroy", auto.auto_id), {
                preserveScroll: true,
                onSuccess: () => {},
                onError: () => {},
                onFinish: () => {},
            });
        },
        applyFilters() {
            this.$inertia.visit(
                route("auto.index", { filters: this.filters }),
                {
                    preserveState: true,
                    method: "get",
                }
            );
        },
        resetFilters() {
            this.filters.autonr = "";
            this.filters.autogads = null;
            this.filters.marka = "";
            this.applyFilters(); // Resetting filters should re-fetch the data without filters
        },
        sort(column) {
            this.sortKey = column;
            this.sortOrder = this.sortOrder === "asc" ? "desc" : "asc";
            this.$inertia.visit(
                route("auto.index", {
                    sortKey: this.sortKey,
                    sortOrder: this.sortOrder,
                }),
                {
                    preserveState: true,
                    method: "get",
                }
            );
            // Logic to sort the table by this.sortKey and this.sortOrder
            // This might also involve a server-side request, similar to applyFilters
        },
        getYearsRange() {
            const currentYear = new Date().getFullYear();
            const years = [];
            for (let year = currentYear; year >= 1900; year--) {
                years.push(year);
            }
            return years;
        },
    },
};
</script>
