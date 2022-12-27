<template>
    <div>
        <div class="d-block">
            <h5 class="text-success">
                <i class="fa-duotone fa-party-horn"></i>
                <span>
                    Success
                </span>
            </h5>
            <div class=" mt-2">
                <!-- <b-avatar size="70" :src="store.getters.latest.profile"
                    :alt="`${store.getters.latest.name}'s profile picture'`"></b-avatar>
                <span>
                    <strong>
                        {{ store.getters.latest.name }}
                    </strong>
                    was clocked In succesfully at
                    <strong>
                        {{ Date.parse(store.getters.latest.attendances[0].created_at) }}
                    </strong>
                    for the {{ `${store.getters.userTypes[latest.type]}s'` }}
                    <strong>
                        {{ store.getters.allShifts.keyboardists.find(shift => shift.id ===
        store.getters.latest.shift_id).name
                        }}<b-avatar size="70" :src="store.getters.latest.profile"
                    :alt="`${store.getters.latest.name}'s profile picture'`"></b-avatar>
                <span>
                    <strong>
                        {{ store.getters.latest.name }}
                    </strong>
                    was clocked In succesfully at
                    <strong>
                        {{ Date.parse(store.getters.latest.attendances[0].created_at) }}
                    </strong>
                    for the {{ `${store.getters.userTypes[latest.type]}s'` }}
                    <strong>
                        {{ store.getters.allShifts.keyboardists.find(shift => shift.id ===
        store.getters.latest.shift_id).name
                        }}
                    </strong>
                </span>
                    </strong>
                </span> -->
                Operation Completed successfully
            </div>

            <vs-button dark size="small" class="mt-3">
                <span class="d-flex flex-row items-center gap-2">
                    <i class="fa-duotone fa-rotate-left h5 m-0"></i>
                    <span class="h5 m-0">
                        undo
                    </span>
                </span>
            </vs-button>
        </div>
    </div>
</template>

<script>
export default {
}
</script>

<style>

</style>
