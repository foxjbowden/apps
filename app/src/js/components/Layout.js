import React from "react";

import Footer from "./Footer";
import Header from "./Header";

export default class Layout extends React.Component {
  constructor() {
    super();
  
  }



  render() {
    return (
      <div>
        <Header />
        <h1>React Setup</h1>
        <Footer />
      </div>
    );
  }
}