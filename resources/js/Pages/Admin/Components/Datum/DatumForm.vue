<script setup>
import {inject} from "vue";

let form = inject('form');
</script>
<template>
    <div>Datum Fields</div>

    <div v-for="(val1, field1) in form.datum">
        <div v-if="typeof(val1) === 'string' || val1 === null">
            {{ field1 }}
            <input v-model="form.datum[field1]"
                   type="text"
                   :name="form.datum[field1]"
                   :id="form.datum[field1]"
                   placeholder=""
            />
        </div>

        <div v-else class="ml-6 mt-10">
            <div v-for="(val2, field2) in val1" class="flex">
                {{ field2 }}
                <div v-if="typeof(val2) === 'string' || val2 === null">
                    <input v-model="form.datum[field1][field2]"
                           type="text"
                           :name="form.datum[field1][field2]"
                           :id="form.datum[field1][field2]"
                           placeholder=""
                    />
                </div>

                <div v-else class="ml-6 mt-10">
                    <div v-for="(val3, field3) in val2" class="flex">
                        {{ field3 }}
                        <div v-if="typeof(val3) === 'string' || val3 === null">
                            <input v-model="form.datum[field1][field2][field3]"
                                   type="text"
                                   :name="form.datum[field1][field2][field3]"
                                   :id="form.datum[field1][field2][field3]"
                                   placeholder=""
                            />
                        </div>

                        <div v-else class="ml-6 mt-10">
                            <div v-for="(val4, field4) in val3" class="flex">
                                {{ field4 }}
                                <div v-if="typeof(val4) === 'string' || val4 === null">
                                    <input v-model="form.datum[field1][field2][field3][field4]"
                                           type="text"
                                           :name="form.datum[field1][field2][field3][field4]"
                                           :id="form.datum[field1][field2][field3][field4]"
                                           placeholder=""
                                    />
                                </div>

                                <div v-else class="ml-6 mt-10">
                                    <div v-for="(val5, field5) in val4" class="flex">
                                        {{ field5 }}
                                        <div v-if="typeof(val5) === 'string' || val5 === null">
                                            <input v-model="form.datum[field1][field2][field3][field4][field5]"
                                                   type="text"
                                                   :name="form.datum[field1][field2][field3][field4][field5]"
                                                   :id="form.datum[field1][field2][field3][field4][field5]"
                                                   placeholder=""
                                            />
                                        </div>

                                        <div v-else class="ml-6 mt-10">
                                            <div v-for="(val6, field6) in val5" class="flex">
                                                {{ field6 }}
                                                <div v-if="typeof(val6) === 'string'">
                                                    <input v-model="form.datum[field1][field2][field3][field4][field5][field6]"
                                                           type="text"
                                                           :name="form.datum[field1][field2][field3][field4][field5][field6]"
                                                           :id="form.datum[field1][field2][field3][field4][field5][field6]"
                                                           placeholder=""
                                                    />
                                                </div>

                                                <div v-else>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
