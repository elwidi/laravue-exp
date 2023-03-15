import axios from "axios";

export default axios.create({
  baseURL: "http://localhost:7991/api/request",
  headers: {
    "Content-type": "application/json"
  }
});