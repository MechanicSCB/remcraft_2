<script setup>
import Bid from "@/Pages/Admin/Bids/Partials/Bid.vue";

defineProps({ bids:Array })
</script>
<template>
    <div class="pb-20">
        <h2 class="text-2xl mb-6">Заявки</h2>

        <!-- TODO add filtering -->

        <div v-for="bid in bids"
             :key="bid.id"
             class="relative border-t py-3"
        >
            <Bid :bid="bid"/>
        </div>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {layout: AdminLayout}
</script>
