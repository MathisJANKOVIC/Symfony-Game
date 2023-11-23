import React from "react";

import Comp1 from "./Comp1"
import Comp2 from "./Comp2"
import { DarkModeProvider } from "./contexts/DarkModeContext";

const DarkModeComponent = () => {
    return <DarkModeProvider>
        <Comp1 />
        <Comp2 />
    </DarkModeProvider>
}

export default DarkModeComponent;