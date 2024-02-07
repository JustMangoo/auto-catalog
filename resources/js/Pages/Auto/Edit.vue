<template>
    <AuthenticatedLayout>
        <Head title="Rediģē Auto" />
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Rediģē Auto
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="p-8 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg"
                >
                    <form @submit.prevent="submit">
                        <div class="space-y-6">
                            <div>
                                <InputLabel
                                    for="autonr"
                                    value="Reģistrācijas numurs"
                                />
                                <TextInput
                                    id="autonr"
                                    v-model="form.autonr"
                                    type="text"
                                    class="block w-full"
                                    autocomplete="autonr"
                                    maxlength="20"
                                    placeholder="piem. AB1234"
                                    style="text-transform: uppercase"
                                    @keydown="allowAlphanumeric($event)"
                                />
                                <InputError
                                    :message="form.errors.autonr"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="autogads"
                                    value="Izlaiduma gads"
                                />
                                <select
                                    id="autogads"
                                    v-model="form.autogads"
                                    class="z-50 block w-full mt-1 border-gray-300 rounded-md shadow-sm shadow-lg dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                >
                                    <option value="" hidden>Atlasi gadu</option>
                                    <option
                                        v-for="year in getYearsRange()"
                                        :key="year"
                                        :value="year"
                                    >
                                        {{ year }}
                                    </option>
                                </select>

                                <InputError
                                    :message="form.errors.autogads"
                                    class="mt-2"
                                />
                            </div>
                            <div>
                                <InputLabel for="marka_id" value="Marka" />
                                <select
                                    id="marka_id"
                                    v-model="form.marka_id"
                                    class="z-50 block w-full mt-1 border-gray-300 rounded-md shadow-sm shadow-lg dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                >
                                    <option value="" disabled hidden>
                                        Izvēlies marku
                                    </option>
                                    <option
                                        v-for="marka in markas"
                                        :key="marka.marka_id"
                                        :value="marka.marka_id"
                                        class="p-2"
                                    >
                                        {{ marka.nosaukums }}
                                    </option>
                                </select>
                                <InputError
                                    :message="form.errors.marka_id"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel for="motors_id" value="Motors" />
                                <select
                                    id="motors_id"
                                    v-model="form.motors_id"
                                    class="z-50 block w-full mt-1 border-gray-300 rounded-md shadow-sm shadow-lg dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                >
                                    <option value="" disabled hidden>
                                        Izvēlies motoru
                                    </option>
                                    <option
                                        v-for="motors in motors"
                                        :key="motors.motors_id"
                                        :value="motors.motors_id"
                                    >
                                        {{ motors.nosaukums }}
                                    </option>
                                </select>
                                <InputError
                                    :message="form.errors.motors_id"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="motoratilpums"
                                    value="Motora tilpums"
                                />
                                <TextInput
                                    id="motoratilpums"
                                    v-model="form.motoratilpums"
                                    type="text"
                                    autocomplete="motoratilpums"
                                    class="block w-full mt-1"
                                    pattern="^[0-9](\.\d{1,2})?$"
                                    placeholder="piem. 1.6"
                                    @keydown="allowNumbersAndDecimal($event)"
                                />
                                <InputError
                                    :message="form.errors.motoratilpums"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="pilnamasa"
                                    value="Pilna masa"
                                />
                                <TextInput
                                    id="pilnamasa"
                                    v-model="form.pilnamasa"
                                    type="number"
                                    autocomplete="pilnamasa"
                                    class="block w-full mt-1"
                                    placeholder="piem. 1234"
                                    @keydown="
                                        allowNumbersAndDecimal($event),
                                            disallowLeadingZero(
                                                $event,
                                                form.pilnamasa
                                            )
                                    "
                                />
                                <InputError
                                    :message="form.errors.pilnamasa"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel for="pasmasa" value="Pašmasa" />
                                <TextInput
                                    id="pasmasa"
                                    v-model="form.pasmasa"
                                    type="number"
                                    autocomplete="pasmasa"
                                    class="block w-full mt-1"
                                    placeholder="piem. 1234"
                                    @keydown="
                                        allowNumbersAndDecimal($event),
                                            disallowLeadingZero(
                                                $event,
                                                form.pasmasa
                                            )
                                    "
                                />
                                <InputError
                                    :message="form.errors.pasmasa"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="piedzina_id"
                                    value="Piedzina"
                                />
                                <select
                                    id="piedzina_id"
                                    v-model="form.piedzina_id"
                                    class="z-50 block w-full mt-1 border-gray-300 rounded-md shadow-sm shadow-lg dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                >
                                    <option value="" disabled hidden>
                                        Izvēlies piedziņu
                                    </option>
                                    <option
                                        v-for="piedzina in piedzinas"
                                        :key="piedzina.piedzina_id"
                                        :value="piedzina.piedzina_id"
                                    >
                                        {{ piedzina.nosaukums }}
                                    </option>
                                </select>
                                <InputError
                                    :message="form.errors.piedzina_id"
                                    class="mt-2"
                                />
                            </div>
                        </div>

                        <div class="flex justify-between mt-8">
                            <PrimaryButton type="submit">
                                <Link :href="route('auto.index')">
                                    Atpakaļ
                                </Link>
                            </PrimaryButton>

                            <PrimaryButton type="submit"
                                >Atjaunot Auto</PrimaryButton
                            >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        PrimaryButton,
        InputError,
        InputLabel,
        TextInput,
    },
    props: {
        auto: Object, // Add this prop to accept the auto being edited
        markas: Array,
        motors: Array,
        piedzinas: Array,
    },
    setup(props) {
        const form = useForm({
            id: props.auto.auto_id, // Make sure to bind the id for the update
            autonr: props.auto.autonr || "",
            autogads: props.auto.autogads || "",
            marka_id: props.auto.marka_id || "",
            motors_id: props.auto.motors_id || "",
            motoratilpums: props.auto.motoratilpums || "",
            pilnamasa: props.auto.pilnamasa || "",
            pasmasa: props.auto.pasmasa || "",
            piedzina_id: props.auto.piedzina_id || "",
        });

        return {
            form,
        };
    },
    methods: {
        submit() {
            this.form.put(route("auto.update", this.form.id), {
                // ...callbacks and other form handling...
            });
        },
        getYearsRange() {
            const currentYear = new Date().getFullYear();
            const years = [];
            for (let year = currentYear; year >= 1900; year--) {
                years.push(year);
            }
            return years;
        },
        allowNumbersAndDecimal(event) {
            // List of allowed keys
            const allowedKeys = ["Backspace", "Tab", "Escape", "Enter", "."];
            // List of allowed control keys
            const controlKeys = ["a", "c", "v", "x"];
            // Allow navigation keys without modifiers (arrows, home, end)
            const navigationKeys = ["ArrowLeft", "ArrowRight", "Home", "End"];

            // Check if any modifier is active (expect for Shift which is allowed for navigation keys)
            const isModifierActive =
                event.ctrlKey || event.altKey || event.metaKey;

            if (
                allowedKeys.includes(event.key) ||
                (controlKeys.includes(event.key.toLowerCase()) &&
                    isModifierActive) ||
                (navigationKeys.includes(event.key) && !event.shiftKey)
            ) {
                return;
            }

            // Allow numbers
            if (event.key >= "0" && event.key <= "9" && !isModifierActive) {
                return;
            }

            // Prevent input if the key is not in the allowed set
            event.preventDefault();
        },
        allowAlphanumeric(event) {
            // Allow control keys: backspace, delete, etc.
            const controlKeys = [
                "Backspace",
                "Delete",
                "Tab",
                "ArrowLeft",
                "ArrowRight",
                "Escape",
                "Enter",
            ];
            if (controlKeys.includes(event.key)) {
                return; // allow the control key
            }

            // Check if it's a letter or number
            const isAlphanumeric = /^[a-zA-Z0-9]$/;
            if (!isAlphanumeric.test(event.key)) {
                event.preventDefault(); // prevent if not alphanumeric
            }
        },
        disallowLeadingZero(event, value) {
            // If the first character is '0' and the input is empty, prevent it
            if (event.key === "0" && (!value || value.length === 0)) {
                event.preventDefault();
            }
        },
    },
};
</script>
