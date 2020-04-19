<template>
  <div class="relative">
    <div
      v-if="loading"
      class="absolute left-0 right-0 bottom-0 top-0 flex items-center justify-center bg-white z-10"
    >
      <div class="loadingio-spinner-ellipsis-8q88i3ji3qt" style="transform: scale(0.5);">
        <div class="ldio-p0haaj8s20g">
          <div class="bg-gray-100"></div>
          <div class="bg-gray-200"></div>
          <div class="bg-gray-300"></div>
          <div class="bg-gray-200"></div>
          <div class="bg-gray-100"></div>
        </div>
      </div>
    </div>
    <div class="text-2xl mb-2">{{ title }}</div>
    <div v-if="subtitle" class="-mt-2 mb-2">{{subtitle}}</div>
    <hr class="border-gray-100" />

    <div
      v-if="error"
      class="p-3 bg-red-400 border-red-200 rounded block mt-4 text-white"
    >{{ this.error }}</div>

    <div v-if="step == 1">
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
            <span class="mt-1 text-base leading-normal">{{ this.csv_file.name || 'Select a file' }}</span>
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

    <div v-if="step == 2">
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

    <div v-if="step == 3">
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

    <div v-if="step == 4">
      <label class="block mt-4">
        <span class="text-gray-700">Requested Limit</span>
        <select class="form-select mt-1 block w-full bg-white border-gray-100">
          <option>$1,000</option>
          <option>$5,000</option>
          <option>$10,000</option>
          <option>$25,000</option>
        </select>
      </label>
      <label class="block mt-4">
        <span class="text-gray-700">Requested Limit</span>
        <select class="form-select mt-1 block w-full bg-white border-gray-100">
          <option>$1,000</option>
          <option>$5,000</option>
          <option>$10,000</option>
          <option>$25,000</option>
        </select>
      </label>
      <label class="block mt-4">
        <span class="text-gray-700">Requested Limit</span>
        <select class="form-select mt-1 block w-full bg-white border-gray-100">
          <option>$1,000</option>
          <option>$5,000</option>
          <option>$10,000</option>
          <option>$25,000</option>
        </select>
      </label>
    </div>

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
        class="px-3 py-1 bg-gray-100 border border-gray-400 text-black rounded float-right"
        @click="proceed(1)"
      >
        <span class="mr-2 uppercase">next</span>
        <i class="far fa-chevron-right"></i>
      </button>
    </div>
  </div>
</template>

<script>
// function localStorageData() {
//   var obj = { $localStorageDataInjection: "asdf" };
//   // console.log(obj);
//   var res = {};
//   // console.log("setting up local storage", this);
//   Object.keys(obj).forEach(key => {

//     res[key] = {
//       get() {
//         return obj[key];
//       },
//       set() {
//         console.log("hello there ", this);
//         console.log("setting data", key);
//       }
//     };
//   });
//   d
//   return res;
// }

export default {
  data() {
    return {
      // sheets_url:
      //   "https://docs.google.com/spreadsheets/d/1BVzVbgptpCN3LQ4vRC8iQHj7QatVcnPStc19CmpHQ4o/edit#gid=0",
      csv_file: "",
      form: null,
      error: null,
      // csv1: {},
      // csv2: {},
      // title: "Import CSV File",
      // subtitle: "",
      loading: true
      // row_ids: [],
      // longestRow1: 0,
      // longestRow2: 0
    };
  },
  localStorage() {
    return {
      step: 1,
      sheets_url:
        "https://docs.google.com/spreadsheets/d/1BVzVbgptpCN3LQ4vRC8iQHj7QatVcnPStc19CmpHQ4o/edit#gid=0",
      // csv_file: "",
      // error: null,
      csv1: {},
      csv2: {},
      title: "Import CSV File",
      subtitle: "",
      // loading: true,
      row_ids: [],
      longestRow1: 0,
      longestRow2: 0
    };
  },
  computed: {
    something() {
      return "somethign";
    }
  },
  mounted() {
    this.loading = false;
  },
  methods: {
    storeGet(item, default_value = null) {
      return JSON.parse(
        localStorage.getItem(item) || JSON.stringify(default_value)
      );
    },
    storePut(item, value) {},
    proceed(count) {
      if (count > 0) {
        if (this["step" + this.step]()) {
          this.step += count;
        }
      } else {
        this.step += count;
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
    getForm() {
      this.form = new FormData();
      return this.form;
    },
    addForm(name, value) {
      if (value) {
        this.form.append(name, value);
      }
    },
    async step1() {
      this.error = null;
      this.loading = true;
      if (this.xor(this.csv_file, this.sheets_url)) {
        this.getForm();
        this.addForm("csv_file", this.csv_file);
        this.addForm("sheets_url", this.sheets_url);
        try {
          var res = await axios.post("/upload/csv1", this.form);
          this.csv1 = res.data.csv;
          this.longestRow1 = res.data.longestRow;
          this.title = "Select Rows";
          this.subtitle =
            "Remove empty, duplicate, and unnecessary rows for best result.";
          this.row_ids = this.csv1.rows.map((x, i) => i);
        } catch (err) {
          this.error = err.response.data.message;
        }
        this.loading = false;
        return true;
      } else {
        this.error = "Link a file OR upload a file. Not both.";
        this.loading = false;
        return false;
      }
    },

    async step2() {
      this.error = null;
      this.loading = true;
      if (this.xor(this.csv_file, this.sheets_url)) {
        this.getForm();
        this.addForm("csv_file", this.csv_file);
        this.addForm("sheets_url", this.sheets_url);
        this.addForm("row_ids", this.row_ids);
        try {
          var res = await axios.post("/upload/csv2", this.form);
          this.csv2 = res.data.csv;
          this.longestRow2 = res.data.longestRow;
          this.title = "Verify CSV";
          this.subtitle =
            "The first row should represent the column names and will not be imported as data.";
        } catch (err) {
          this.error = err.response.data.message;
        }
        this.loading = false;
        return true;
      } else {
        this.error = "Link a file OR upload a file. Not both.";
        this.loading = false;
        return false;
      }
    }
  }
};
</script>
