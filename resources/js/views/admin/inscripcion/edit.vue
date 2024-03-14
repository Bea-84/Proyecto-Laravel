<template>
    <div class="row justify-content-center my-5">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form @submit.prevent="submitForm">
                        <div class="mb-3">
                            <label for="inscripcion-fecha" class="form-label">Fecha</label>
                            <input v-model="inscripcion.fecha" id="inscripcion-fecha" type="text" class="form-control">
                            <div class="text-danger mt-1">
                                {{ errors.name }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.fecha">
                                    {{ message }}
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="forma_de_pago" class="form-label">Forma de pago</label>
                            <input v-model="inscripcion.forma_de_pago" id="forma_de_pago" type="text" class="form-control">
                            <div class="text-danger mt-1">
                                {{ errors.forma_de_pago }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.forma_de_pago">
                                    {{ message }}
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="user_id" class="form-label">User Id</label>
                            <input v-model="inscripcion.user_id" id="user_id" type="bigInteger" class="form-control">
                            <div class="text-danger mt-1">
                                {{ errors.user_id }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.user_id">
                                    {{ message }}
                                </div>
                            </div>
                        </div>
                        <!-- Role -->
                        <div class="mb-3">
                            <label for="user-category" class="form-label">
                                Role
                            </label>
                            <v-select multiple  v-model="user.role_id" :options="roleList" :reduce="role => role.id" label="name" class="form-control" />
                            <div class="text-danger mt-1">
                                {{ errors.role_id }}
                            </div>
                            <div class="text-danger mt-1">
                                <div v-for="message in validationErrors?.role_id">
                                    {{ message }}
                                </div>
                            </div>
                        </div>
                        <!-- Buttons -->
                        <div class="mt-4">
                            <button :disabled="isLoading" class="btn btn-primary">
                                <div v-show="isLoading" class=""></div>
                                <span v-if="isLoading">Processing...</span>
                                <span v-else>Save</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { onMounted, reactive, watchEffect } from "vue";
    import { useRoute } from "vue-router";
    import useRoles from "@/composables/roles";
    import useUsers from "@/composables/users";

    const { roleList, getRoleList } = useRoles();
    const { updateUser, getUser, user: postData, validationErrors, isLoading } = useUsers();

    import { useForm, useField, defineRule } from "vee-validate";
    import { required, min } from "@/validation/rules"
    defineRule('required', required)
    defineRule('min', min);

    // Define a validation schema
    const schema = {
        name: 'required',
        email: 'required',
        password: 'min:8',
    }

    // Create a form context with the validation schema
    const { validate, errors, resetForm } = useForm({ validationSchema: schema })
    // Define actual fields for validation
    const { value: fecha } = useField('fecha', null, { initialValue: '' });
    const { value: forma_de_pago } = useField('forma_de_pago', null, { initialValue: '' });
    const { value: user_id } = useField('user_id', null, { initialValue: '' });


    const inscripcion = reactive({
        fecha,
        forma_de_pago,
        user_id
    })

    const route = useRoute()
    function submitForm() {
        validate().then(form => { if (form.valid) updateUser(user) })
    }
    onMounted(() => {
        getUser(route.params.id)
        getRoleList()
    })
    // https://vuejs.org/api/reactivity-core.html#watcheffect
    watchEffect(() => {
        user.id = postData.value.id
        user.fecha = postData.value.fecha
        user.user_id = postData.value.user_id
    })
</script>