import http from "../../../http-common";

class DataService {
  getAll(params) {
    return http.get("", { params });
  }

  // other CRUD methods
}

export default new DataService();