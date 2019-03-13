<template>
    <div>
        <!-- Modal starts -->
        <div
            class="modal fade"
            id="showComputerModal"
            tabindex="-1"
            role="dialog"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Computer Detail - {{ editList.control }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <span class="fa fa-gear"></span> Details
                                        </h4>
                                        <table class="table table-sm table-responsive">
                                            <thead>
                                                <tr>
                                                    <td>Part</td>
                                                    <td>Description</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Control</td>
                                                    <td>{{editList.control}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Operator</td>
                                                    <td>{{editList.operator}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Office 1</td>
                                                    <td
                                                        v-if="editList.office"
                                                    >{{editList.office.description}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Office 2</td>
                                                    <td
                                                        v-if="editList.office"
                                                    >{{editList.office.main_office}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Purchased</td>
                                                    <td>{{editList.datePurchased}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Type</td>
                                                    <td>{{editList.type}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Propery</td>
                                                    <td>{{editList.property}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Motherboard</td>
                                                    <td>{{editList.motherboard}}</td>
                                                </tr>
                                                <tr>
                                                    <td>IP Address</td>
                                                    <td>{{editList.ip_address}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Mac Address</td>
                                                    <td>{{editList.mac_address}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Serial</td>
                                                    <td>{{editList.serial}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Printer</td>
                                                    <td>{{editList.printer}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Scanner</td>
                                                    <td>{{editList.scanner}}</td>
                                                </tr>
                                                <tr>
                                                    <td>OS</td>
                                                    <td>{{editList.osx}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Apps</td>
                                                    <td>{{editList.applications}}</td>
                                                </tr>
                                                <tr>
                                                    <td>License</td>
                                                    <td>{{editList.licence}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Standalone</td>
                                                    <td v-if="editList.isStandAlone!=0">Yes</td>
                                                    <td v-else>No</td>
                                                </tr>
                                                <tr>
                                                    <td>Internet</td>
                                                    <td v-if="editList.isInternet!=0">Yes</td>
                                                    <td v-else>No</td>
                                                </tr>
                                                <tr>
                                                    <td>Network</td>
                                                    <td v-if="editList.isNetwork!=0">Yes</td>
                                                    <td v-else>No</td>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <td>{{editList.generalStatus}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row justify-content-between">
                                            <div class="col-4">
                                                <h4 class="card-title">
                                                    <span class="fa fa-gear"></span> Parts
                                                </h4>
                                            </div>
                                            <div class="col-4">
                                                <button
                                                    type="button"
                                                    class="btn btn-link bg-white border-0 px-1 py-0"
                                                >
                                                    <span
                                                        @click="editPart()"
                                                        class="fa fa-plus"
                                                    ></span>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <table class="table table-sm table-responsive">
                                            <thead>
                                                <tr>
                                                    <td></td>
                                                    <td>Part</td>
                                                    <td>Description</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in brandList">
                                                    <td>
                                                        <div
                                                            class="btn-group btn-group-sm border-0"
                                                            role="group"
                                                            aria-label="Basic example"
                                                        >
                                                            <button
                                                                type="button"
                                                                class="btn btn-link bg-white border-0 px-1 py-0"
                                                                v-if="!edited || partsInput==index"
                                                            >
                                                                <span
                                                                    @click="editPart(index)"
                                                                    class="fa fa-edit"
                                                                    v-if="!edited"
                                                                ></span>
                                                                <span
                                                                    @click="savePart(index, item.id)"
                                                                    class="fa fa-save"
                                                                    v-else
                                                                ></span>
                                                            </button>
                                                            <button
                                                                type="button"
                                                                class="btn btn-link bg-white border-0 px-1 py-0"
                                                                v-if="!edited || partsInput==index"
                                                            >
                                                                <span
                                                                    class="fa fa-trash text-danger"
                                                                    @click="deletePart(index, item.id)"
                                                                    v-if="!edited"
                                                                ></span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td>{{item.part.description}}</td>
                                                    <td>
                                                        <span
                                                            v-if="partsInput!=index || !edited"
                                                        >{{item.description}}</span>
                                                        <input
                                                            v-else
                                                            type="text"
                                                            class="form-control"
                                                            v-model="item.description"
                                                        >
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <span class="fa fa-gear"></span> Maintenance
                                        </h4>
                                        <table class="table table-sm table-responsive">
                                            <thead>
                                                <tr>
                                                    <td></td>
                                                    <td>Date</td>
                                                    <td>Findings</td>
                                                    <td>Checked By</td>
                                                    <td>Remarks</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in maintainList">
                                                    <td>
                                                        <div
                                                            class="btn-group btn-group-sm border-0"
                                                            role="group"
                                                            aria-label="Basic example"
                                                        >
                                                            <button
                                                                type="button"
                                                                class="btn btn-link bg-white border-0 px-1 py-0"
                                                            >
                                                                <span class="fa fa-edit"></span>
                                                            </button>
                                                            <button
                                                                type="button"
                                                                class="btn btn-link bg-white border-0 px-1 py-0"
                                                            >
                                                                <span
                                                                    class="fa fa-trash text-danger"
                                                                ></span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td>{{item.dateEncoded}}</td>
                                                    <td>{{item.findings}}</td>
                                                    <td>{{item.checkedBy}}</td>
                                                    <td>{{item.remarks}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Ends -->
    </div>
</template>

<script>
export default {
    props: ["editList", "brandList", "maintainList"],
    data() {
        return {
            list: [],
            partsInput: "-1",
            edited: false,
            newPart: ""
        };
    },
    methods: {
        editPart(index) {
            this.partsInput = index;
            this.edited = true;
        },
        savePart(index, id) {
            this.partsInput = index;
            this.edited = false;

            axios
                .patch("/brands/" + id, this.brandList[index])
                .then(response => {});
        },
        deletePart(index, id) {
            var self = this
            axios.delete("/brands/" + id).then(response => {

                self.brandList.splice(index, 1)

            });
        }
    }
};
</script>