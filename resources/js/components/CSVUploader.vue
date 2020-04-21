<template>
  <div class="relative overflow-hidden">
    <vue-transition-slide :direction="direction">
      <div v-if="step == 1" :key="1">
        <div class="text-2xl mb-2">Import CSV File</div>
        <div class="-mt-2 mb-2">Link or upload a CSV file to add large amounts of data.</div>
      </div>

      <div v-if="step == 2" :key="2">
        <div class="text-2xl mb-2">Select Rows</div>
        <div class="-mt-2 mb-2">Remove empty, duplicate, and unnecessary rows for best result.</div>
      </div>

      <div v-if="step == 3" :key="3">
        <div class="text-2xl mb-2">Verify CSV</div>
        <div
          class="-mt-2 mb-2"
        >The first row should represent the column names and will not be imported as data.</div>
      </div>

      <div v-if="step == 4" :key="4">
        <div class="text-2xl mb-2">Sort Data</div>
        <div class="-mt-2 mb-2">Sort your data into the appropriate fields.</div>
        <div class="-mt-2 mb-2 text-red font-bold">THIS CANNOT BE FINISHED UNTIL WE DESIGN DATABASE.</div>
      </div>
    </vue-transition-slide>

    <hr class="border-gray-100" />

    <div
      v-if="error"
      class="p-3 bg-red-400 border-red-200 rounded block mt-4 text-white"
    >{{ this.error }}</div>

    <vue-transition-slide :direction="direction">
      <div v-if="step == 1" :key="1">
        <vue-loading-ellipsis
          v-if="loading"
          class="absolute left-0 right-0 bottom-0 top-0 flex items-center justify-center bg-white z-10"
        ></vue-loading-ellipsis>
        <label class="block mt-4">
          <span class="text-gray-700">Google Sheets URL</span>
          <input
            v-model="sheets_url"
            type="url"
            class="form-input mt-1 block w-full bg-gray-100 text-black border-gray-400"
            placeholder="https://docs.google.com/spreadsheets/d/***"
          />
        </label>
        <div class="flex items-center justify-center my-4">
          <div class="p-3 bg-gray-100 border-gray-200 rounded inline-block">OR</div>
        </div>

        <div class="flex items-center justify-center mb-4">
          <label
            @click="$refs.csv_file.click()"
            class="w-full bg-gray-100 py-4 text-black border border-gray-400 rounded-lg inline-block hover:bg-blue-400 hover:border-blue-400 hover:text-white cursor-pointer"
          >
            <div class="flex flex-col items-center justify-center">
              <i :class="['fas', iconClass(), 'fa-lg']"></i>
              <span
                class="mt-1 text-base leading-normal"
              >{{ this.csv_file.name || 'Select a file' }}</span>
            </div>

            <input type="file" class="hidden" ref="csv_file" @change="changeFile" />
          </label>
          <button
            v-if="csv_file"
            @click="csv_file=''"
            class="px-4 bg-gray-100 py-4 text-black border border-gray-400 rounded-lg inline-block hover:bg-red-400 hover:border-red-400 hover:text-white cursor-pointer"
          >
            <div class="flex flex-col items-center justify-center">
              <i class="fas fa-times fa-lg"></i>
              <span class="mt-1 text-base leading-normal">Clear</span>
            </div>
          </button>
        </div>
      </div>

      <div v-if="step == 2" :key="2">
        <vue-loading-ellipsis
          v-if="loading"
          class="absolute left-0 right-0 bottom-0 top-0 flex items-center justify-center bg-white z-10"
        ></vue-loading-ellipsis>
        <div class="grid-wrapper border">
          <div
            class="grid grid-table"
            :style="`grid-template-columns: 1fr repeat(${longestRow1}, minmax(150px, auto))`"
          >
            <template v-for="(row, row_id) in csv1.rows">
              <label class="inline-flex items-center bg-white sticky left-0" :key="row_id">
                <input
                  type="checkbox"
                  class="form-checkbox h-6 w-6 text-green-400"
                  checked
                  :value="row_id"
                  v-model="row_ids"
                />
              </label>
              <div v-for="(item, item_id) in row" :key="row_id + '-' + item_id">
                <div class="overflow-hidden">{{item}}</div>
              </div>
            </template>
          </div>
        </div>
      </div>

      <div v-if="step == 3" :key="3">
        <vue-loading-ellipsis
          v-if="loading"
          class="absolute left-0 right-0 bottom-0 top-0 flex items-center justify-center bg-white z-10"
        ></vue-loading-ellipsis>
        <div class="grid-wrapper border">
          <div
            class="grid grid-table"
            :style="`grid-template-columns: repeat(${longestRow2}, minmax(150px, auto))`"
          >
            <template v-for="(row, row_id) in csv2.rows">
              <div v-for="(item, item_id) in row" :key="row_id + '-' + item_id">
                <div class="overflow-hidden">{{item}}</div>
              </div>
            </template>
          </div>
        </div>
      </div>

      <div v-if="step == 4" :key="4">
        <vue-loading-ellipsis
          v-if="loading"
          class="absolute left-0 right-0 bottom-0 top-0 flex items-center justify-center bg-white z-10"
        ></vue-loading-ellipsis>
        <label class="block mt-4" v-for="field in fields" :key="field">
          <span class="text-gray-700">{{ field }}</span>
          <select class="form-select mt-1 block w-full bg-white border-gray-100">
            <option v-for="column in Object.keys(final_columns)" :key="column">{{column}}</option>
          </select>
        </label>
      </div>
    </vue-transition-slide>

    <hr class="border-gray-100 mt-4" />
    <div class="mt-4 clearfix">
      <button
        class="px-3 py-1 bg-gray-100 border border-gray-400 text-black rounded float-left"
        v-if="step > 1"
        @click="proceed(-1)"
      >
        <i class="far fa-chevron-left"></i>
        <span class="ml-2 uppercase">back</span>
      </button>
      <button
        v-if="step < max_steps"
        class="px-3 py-1 bg-gray-100 border border-gray-400 text-black rounded float-right"
        @click="proceed(1)"
      >
        <span class="mr-2 uppercase">next</span>
        <i class="far fa-chevron-right"></i>
      </button>

      <button
        v-if="step == max_steps"
        class="px-3 py-1 bg-blue-400 border border-blue-600 text-black rounded float-right"
      >
        <span class="mr-2 uppercase">done</span>
        <i class="far fa-check"></i>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      csv_file: "",
      form: null,
      error: null,
      loading: true,
      direction: "left",
      fields: [],
      final_columns: {},
      max_steps: 4,

      step: 1,
      sheets_url:
        "https://docs.google.com/spreadsheets/d/1BVzVbgptpCN3LQ4vRC8iQHj7QatVcnPStc19CmpHQ4o/edit#gid=0",
      csv1: {},
      csv2: {},
      row_ids: [],
      longestRow1: 0,
      longestRow2: 0
    };
  },
  // localStorage() {
  //   return {
  //     step: 1,
  //     sheets_url:
  //       "https://docs.google.com/spreadsheets/d/1BVzVbgptpCN3LQ4vRC8iQHj7QatVcnPStc19CmpHQ4o/edit#gid=0",
  //     csv1: {},
  //     csv2: {},
  //     row_ids: [],
  //     longestRow1: 0,
  //     longestRow2: 0
  //   };
  // },
  mounted() {
    this.loading = false;
  },
  methods: {
    async proceed(count) {
      this.error = null;
      this.loading = true;
      this.direction = count > 0 ? "left" : "right";
      this.step = count > 0 ? this.step : this.step + count;
      try {
        await this[`step${this.step}`]();
        this.step = count < 0 ? this.step : this.step + count;
        this.loading = false;
      } catch (err) {
        this.error = err.message;
      }
    },
    xor(a, b) {
      return !!a ^ !!b;
    },
    iconClass() {
      if (this.csv_file) {
        return this.csv_file.type == "application/vnd.ms-excel"
          ? "fa-file-csv"
          : "fa-file-times";
      } else {
        return "fa-cloud-upload";
      }
    },
    changeFile() {
      this.csv_file = this.$refs.csv_file.files[0];
    },
    resetForm() {
      this.form = new FormData();
      return this.form;
    },
    setForm(obj) {
      this.resetForm();
      Object.keys(obj).forEach(key => {
        if (obj[key]) {
          this.form.append(key, obj[key]);
        }
      });
    },

    async step1() {
      if (!this.xor(this.csv_file, this.sheets_url)) {
        throw new Error("Link a file OR upload a file. Not both.");
      }
      this.setForm({
        csv_file: this.csv_file,
        sheets_url: this.sheets_url
      });

      try {
        var res = await axios.post("/upload/csv1", this.form);
        this.csv1 = res.data.csv;
        this.longestRow1 = res.data.longestRow;
        this.row_ids = this.csv1.rows.map((x, i) => i);
      } catch (err) {
        throw new Error(err.response.data.message);
      }
    },

    async step2() {
      if (!this.xor(this.csv_file, this.sheets_url)) {
        throw new Error("Link a file OR upload a file. Not both.");
      }

      this.setForm({
        csv_file: this.csv_file,
        sheets_url: this.sheets_url,
        row_ids: this.row_ids
      });

      try {
        var res = await axios.post("/upload/csv2", this.form);
        this.csv2 = res.data.csv;
        this.longestRow2 = res.data.longestRow;
      } catch (err) {
        throw new Error(err.response.data.message);
      }
    },

    async step3() {
      if (!this.xor(this.csv_file, this.sheets_url)) {
        throw new Error("Link a file OR upload a file. Not both.");
      }

      this.setForm({
        csv_file: this.csv_file,
        sheets_url: this.sheets_url,
        row_ids: this.row_ids
      });

      try {
        var res = await axios.post("/upload/csv3", this.form);
        this.fields = res.data.fields;
        this.final_columns = res.data.data;
        console.log(res.data.data);
        // this.csv2 = res.data.csv;
        // this.longestRow2 = res.data.longestRow;
      } catch (err) {
        throw new Error(err.response.data.message);
      }
    }
  }
};
</script>
