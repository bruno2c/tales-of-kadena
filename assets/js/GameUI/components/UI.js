import React from 'react'
import { UI_GENERAL_BATTLE, UI_OPTION_DOWN, UI_OPTION_UP } from '../constants/UIConstants'

class UI extends React.Component {

    constructor(props) {
        super(props);
        this.handleKeyUp = this.handleKeyUp.bind(this);
    }

    handleKeyUp(event) {

        if (event.keyCode === 38) {
            this.props.changeOption({
                currentLevel: this.props.currentLevel,
                currentLevel1Action: this.props.currentLevel1Action,
                currentLevel2Action: this.props.currentLevel2Action,
                direction: UI_OPTION_UP
            });
        }

        if (event.keyCode === 40) {
            this.props.changeOption({
                currentLevel: this.props.currentLevel,
                currentLevel1Action: this.props.currentLevel1Action,
                currentLevel2Action: this.props.currentLevel2Action,
                direction: UI_OPTION_DOWN
            });
        }

        if (event.keyCode === 13) {
            this.props.changeLevel(this.props.currentLevel + 1);
        }

        if (event.keyCode === 27) {
            this.props.changeLevel(this.props.currentLevel - 1);
        }
    };

    componentDidMount(){
        document.addEventListener("keydown", this.handleKeyUp, false);
    }
    componentWillUnmount(){
        document.removeEventListener("keydown", this.handleKeyUp, false);
    }

    render() {
        return (
            <div className={"ui-bar"}>
                <div className={"champions"}>
                    <div className={"slot"}>
                        <img className={"charPicture"}/>
                        <div>
                            <div className={"name"}>Test</div>
                            <div className="health-bar">
                                <div className="current">&nbsp;</div>
                                <div className="border">&nbsp;</div>
                                <span className="text">1 / 50</span>
                            </div>
                        </div>
                    </div>
                    <div className={"slot"}>
                        <img className={"charPicture"}/>
                        <div>
                            <div className={"name"}>Test</div>
                            <div className="health-bar">
                                <div className="current">&nbsp;</div>
                                <div className="border">&nbsp;</div>
                                <span className="text">1 / 50</span>
                            </div>
                        </div>
                    </div>
                    <div className={"slot"}>
                        <img className={"charPicture"}/>
                        <div>
                            <div className={"name"}>Test</div>
                            <div className="health-bar">
                                <div className="current">&nbsp;</div>
                                <div className="border">&nbsp;</div>
                                <span className="text">1 / 50</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div className={"actions"}>
                    <div className={"general"}>
                        <i className={"arrow-option " + this.props.currentLevel1Action}></i>
                        <div className={"option"}>Battle</div>
                        <div className={"option"}>Items</div>
                        <div className={"option"}>Run</div>
                    </div>
                    { (this.props.currentLevel === 2 && this.props.currentLevel1Action === UI_GENERAL_BATTLE) ?
                        <div className={"battle-actions"}>
                            <i className={"arrow-option " + this.props.currentLevel2Action}></i>
                            <div className={"option"}>Attack</div>
                            <div className={"option"}>Defend</div>
                        </div>
                        : ''
                    }
                </div>

                <div className={"enemies"}>
                    <div className={"slot"}>
                        <img className={"charPicture"}/>
                        <div>
                            <div className={"name"}>Test</div>
                            <div className="health-bar">
                                <div className="current">&nbsp;</div>
                                <div className="border">&nbsp;</div>
                                <span className="text">1 / 50</span>
                            </div>
                        </div>
                    </div>
                    <div className={"slot"}>
                        <img className={"charPicture"}/>
                        <div>
                            <div className={"name"}>Test</div>
                            <div className="health-bar">
                                <div className="current">&nbsp;</div>
                                <div className="border">&nbsp;</div>
                                <span className="text">1 / 50</span>
                            </div>
                        </div>
                    </div>
                    <div className={"slot"}>
                        <img className={"charPicture"}/>
                        <div>
                            <div className={"name"}>Test</div>
                            <div className="health-bar">
                                <div className="current">&nbsp;</div>
                                <div className="border">&nbsp;</div>
                                <span className="text">1 / 50</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        )
    }
}

export default UI