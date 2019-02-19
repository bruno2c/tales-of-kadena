import React from 'react'

class UI extends React.Component {

    constructor(props) {
        super(props);
        this.handleKeyUp = this.handleKeyUp.bind(this);
    }

    handleKeyUp(event) {

        if (event.keyCode === 38) {
            if (!this.props.lockGeneralAction) {
                this.props.changeOption(this.props.generalAction, 'up');
            }
        }

        if (event.keyCode === 40) {
            if (!this.props.lockGeneralAction) {
                this.props.changeOption(this.props.generalAction,'down');
            }
        }

        if (event.keyCode === 13) {
            if (!this.props.lockGeneralAction) {
                this.props.lockGeneral();
            }
        }

        if (event.keyCode === 27) {
            if (this.props.lockGeneralAction) {
                this.props.unlockGeneral();
            }
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
                        <i className={"arrow-option " + this.props.generalAction}></i>
                        <div className={"option"}>Battle</div>
                        <div className={"option"}>Items</div>
                        <div className={"option"}>Run</div>
                    </div>
                    { (this.props.lockGeneralAction && this.props.generalAction == 'battle') ?
                        <div className={"battle-actions"}>
                            <i className={"arrow-option " + this.props.generalAction}></i>
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