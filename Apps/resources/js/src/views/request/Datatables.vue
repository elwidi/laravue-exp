<template>
    <v-row align="center" class="list px-3 mx-auto">
      <v-col cols="12" sm="8">
        <v-text-field v-model="searchTitle" label="Search by Title"></v-text-field>
      </v-col>
  
      <v-col cols="12" sm="4">
        <v-btn small @click="page = 1; retrieveTutorials();">
          Search
        </v-btn>
      </v-col>
  
      <v-col cols="12" sm="12">
        <v-row>
          <v-col cols="4" sm="3">
            <v-select
              v-model="pageSize"
              :items="pageSizes"
              label="Items per Page"
              @change="handlePageSizeChange"
            ></v-select>
          </v-col>
  
          <v-col cols="12" sm="9">
            <v-pagination
              v-model="page"
              :length="totalPages"
              total-visible="7"
              next-icon="mdi-menu-right"
              prev-icon="mdi-menu-left"
              @input="handlePageChange"
            ></v-pagination>
          </v-col>
        </v-row>
      </v-col>
  
      <v-col cols="12" sm="12">
        <v-card class="mx-auto" tile>
          <v-card-title>Users</v-card-title>
  
          <v-data-table
            :headers="headers"
            :items="tutorials"
            item-key="full_name"
            class="table-rounded"
            hide-default-footer
            disable-sort
            >
            <template v-slot:[`item.actions`]="{ item }">
              <v-icon small class="mr-2" @click="editTutorial(item.id)">
                mdi-pencil
              </v-icon>
              <v-icon small @click="deleteTutorial(item.id)">
                mdi-delete
              </v-icon>
            </template>
          </v-data-table>
        </v-card>
      </v-col>
    </v-row>
  </template>
  <script>
  import DataService from "./service/DataService";
  export default {
    name: "tutorials-list",
    data() {
      return {
        tutorials: [],
        searchTitle: "",
        headers: [
          { text: "Title", align: "start", sortable: false, value: "title" },
          { text: "Description", value: "description", sortable: false },
          { text: "Status", value: "status", sortable: false },
          { text: "Actions", value: "actions", sortable: false },
        ],
  
        page: 1,
        totalPages: 0,
        pageSize: 10,
  
        pageSizes: [10, 25, 50, 100],
      };
    },
    methods: {
      getRequestParams(searchTitle, page, pageSize) {
        let params = {};
  
        if (searchTitle) {
          params["title"] = searchTitle;
        }
  
        if (page) {
          params["page"] = page - 1;
        }
  
        if (pageSize) {
          params["size"] = pageSize;
        }
  
        return params;
      },
  
      retrieveTutorials() {
        const params = this.getRequestParams(
          this.searchTitle,
          this.page,
          this.pageSize
        );
  
        DataService.getAll(params)
          .then((response) => {
            const { tutorials, totalPages } = response.data;
            console.log(response)
            this.tutorials = tutorials.map(this.getDisplayTutorial);
            this.totalPages = totalPages;
  
            console.log(response.data);
          })
          .catch((e) => {
            console.log(e);
          });
      },
  
      handlePageChange(value) {
        this.page = value;
        this.retrieveTutorials();
      },
  
      handlePageSizeChange(size) {
        this.pageSize = size;
        this.page = 1;
        this.retrieveTutorials();
      },
  
      getDisplayTutorial(tutorial) {
        return {
          id: tutorial.id,
          title: tutorial.employee_id,
          description: tutorial.email,
          status: tutorial.password,
        };
      },
    },
    mounted() {
      this.retrieveTutorials();
    },
  };
  </script>