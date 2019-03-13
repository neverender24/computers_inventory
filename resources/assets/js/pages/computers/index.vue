<template>
    <div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Dispositions</h4>
                <div class="row">
                    <div class="form-group col-2">
                        <select v-model="tableData.show" @change="getData()" class="form-control">
                            <option value="all">All</option>
                            <option value="available" selected>Available</option>
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-filter"></i>
                                </span>
                            </div>
                            <input
                                type="date"
                                class="form-control"
                                v-model="tableData.search"
                                @input="getData()"
                            >
                        </div>
                    </div>
                </div>

                <datatable
                    :columns="columns"
                    :sortKey="sortKey"
                    :sortOrders="sortOrders"
                    @sort="sortBy"
                >
                    <tbody>
                        <tr v-for="item in list" :key="item.control">
                            <td>{{ item.control }}</td>
                            <td>{{ item.operator }}</td>
                            <td>{{ item.office.description }}</td>
                            <td>{{ item.type }}</td>
                            <td>{{ item.datePurchased }}</td>
                            <!-- General Status -->
                            <td v-if="item.generalStatus=='Good'">
                                <span class="badge badge-success">{{ item.generalStatus }}</span>
                            </td>
                            <td v-if="item.generalStatus=='Returned'">
                                <span class="badge badge-warning">{{ item.generalStatus }}</span>
                            </td>
                            <td v-if="item.generalStatus=='Damaged'">
                                <span class="badge badge-danger">{{ item.generalStatus }}</span>
                            </td>
                            <td v-if="item.generalStatus=='' || item.generalStatus=='-'">-</td>
                            <td>
                                <div
                                    class="btn-group btn-group-sm border-0"
                                    role="group"
                                    aria-label="Basic example"
                                >
                                    <button
                                        type="button"
                                        class="btn btn-link bg-white border-0 py-0"
                                        data-toggle="modal"
                                        data-target="#showComputerModal"
                                        @click="show(item.id)"
                                    >
                                        <span class="fa fa-eye text-dark"></span>
                                    </button>
                                    <button type="button" class="btn btn-link bg-white border-0 py-0">
                                        <span class="fa fa-edit"></span>
                                    </button>
                                    <button type="button" class="btn btn-link bg-white border-0 py-0">
                                        <span class="fa fa-trash text-danger"></span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </datatable>
                <pagination
                    :pagination="pagination"
                    @prev="getData(pagination.prevPageUrl)"
                    @next="getData(pagination.nextPageUrl)"
                ></pagination>
            </div>
            <show :editList="editList" :brandList="brandList" :maintainList="maintainList"></show>
        </div>
    </div>
</template>

<script>
import Datatable from "../../helpers/datatable.vue";
import Pagination from "../../helpers/pagination.vue";
import Show from "../computers/show";

export default {
    components: {
        datatable: Datatable,
        pagination: Pagination,
        Show
    },
    data() {
        // pagination related variables
        let sortOrders = {};

        let columns = [
            { width: "10%", label: "Control", name: "Control" },
            { width: "20%", label: "Operator", name: "Operator" },
            { width: "20%", label: "Office", name: "Office" },
            { width: "10%", label: "Type", name: "Type" },
            { width: "20%", label: "Date Purchased", name: "DatePurchased" },
            { width: "20%", label: "Status", name: "Status" }
        ];

        columns.forEach(column => {
            sortOrders[column.name] = -1;
        });
        // end pagination

        return {
            // pagination variables
            columns: columns,
            sortKey: "control",
            sortOrders: sortOrders,
            tableData: {
                draw: 0,
                length: 15,
                search: "",
                column: 0,
                dir: "desc",
                show: "available"
            },
            pagination: {
                lastPage: "",
                currentPage: "",
                total: "",
                lastPageUrl: "",
                nextPageUrl: "",
                prevPageUrl: "",
                from: "",
                to: ""
            },
            // end pagination
            list: [],
            editList: [],
            brandList: [],
            maintainList: []
        };
    },
    mounted() {
        this.getData();
    },
    methods: {
        // Pagination start
        configPagination(data) {
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.lastPageUrl = data.last_page_url;
            this.pagination.prevPageUrl = data.prev_page_url;
            this.pagination.nextPageUrl = data.next_page_url;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
        },
        sortBy(key) {
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, "name", key);
            this.tableData.dir = this.sortOrders[key] === 1 ? "asc" : "desc";
            this.getData();
        },

        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value);
        },

        getData(url = "computers") {
            axios.get(url, { params: this.tableData }).then(response => {
                let data = response.data;

                if (this.tableData.draw == data.draw) {
                    this.list = data.data.data;
                    this.configPagination(data.data);
                }
            });
        },
        // end pagination

        show(id) {
            axios.get("/computers/" + id).then(response => {
                this.editList = response.data;
            });

            axios.post("/brands/", { computer_id: id }).then(response => {
                this.brandList = response.data;
            });

            axios.post("/maintains/", { computer_id: id }).then(response => {
                this.maintainList = response.data;
            });
        },

        del(id) {
            this.$snotify.confirm("You are about to delete. Continue?", "", {
                pauseOnHover: true,
                position: "centerCenter",
                buttons: [
                    {
                        text: "Yes",
                        action: () => {
                            axios
                                .delete("/dispositions/" + id)
                                .then(response => {
                                    this.getData();
                                    this.$emit("notify");
                                    this.$toasted.show("Successfully Deleted", {
                                        type: "success",
                                        theme: "bubble",
                                        position: "top-right",
                                        duration: 5000
                                    });
                                });

                            this.$snotify.remove();
                        },
                        bold: false
                    },
                    { text: "No", action: () => this.$snotify.remove() }
                ]
            });
        },

        nearExpire(date) {
            const startDate = date;
            const endDate = new Date();
            const timeDiff = new Date(startDate) - endDate;
            const days = timeDiff / (1000 * 60 * 60 * 24);

            if (days <= 35) {
                return true;
            } else {
                return false;
            }
        },

        refreshNotification() {
            this.$emit("notify");
        }
    }
};
</script>