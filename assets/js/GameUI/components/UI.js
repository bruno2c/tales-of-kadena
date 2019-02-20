import React from 'react'
import { UI_LEVEL_2_BATTLE, UI_OPTION_DOWN, UI_OPTION_UP } from '../constants/UIConstants'
import ChampionContainer from "./Arena";

class UI extends React.Component {

    constructor(props) {
        super(props);
        this.handleKeyUp = this.handleKeyUp.bind(this);
    }

    handleKeyUp(event) {

        if (event.keyCode === 38) {
            this.props.changeOption(UI_OPTION_UP);
        }

        if (event.keyCode === 40) {
            this.props.changeOption(UI_OPTION_DOWN);
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
                    <i className={"arrow-option " + this.props.currentLevel1Action}></i>

                    {Object.keys(this.props.arena.champions).map(key => (
                        <div className={"slot"} key={key}>
                            <img className={"charPicture"} />
                            <div>
                                <div className={"name"}>{ this.props.arena.champions[key].name }</div>
                                <div className="health-bar">
                                    <div className="current" style={{
                                        width: (this.props.arena.champions[key].healthPercentage < 3) ? '3%'
                                            : (this.props.arena.champions[key].healthPercentage > 99) ? '99%'
                                            : this.props.arena.champions[key].healthPercentage + '%'
                                    }}>&nbsp;</div>
                                    <div className="border">&nbsp;</div>
                                    <span className="text">{ this.props.arena.champions[key].health } / { this.props.arena.champions[key].maxHealth }</span>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>

                <div className={"actions"}>

                    {(this.props.currentLevel > 1) ?
                        <div className={"general"}>
                            <i className={"arrow-option " + this.props.currentLevel2Action}></i>
                            <div className={"option"}>Battle</div>
                            <div className={"option"}>Items</div>
                            <div className={"option"}>Run</div>
                        </div>
                        : ''
                    }

                    { (this.props.currentLevel > 2 && this.props.currentLevel2Action === UI_LEVEL_2_BATTLE) ?
                        <div className={"battle-actions"}>
                            <i className={"arrow-option " + this.props.currentLevel3Action}></i>
                            <div className={"option"}>Attack</div>
                            <div className={"option"}>Defend</div>
                        </div>
                        : ''
                    }
                </div>

                <div className={"enemies"}>
                    {(this.props.currentLevel === 4) ?
                        <i className={"arrow-option " + this.props.currentLevel4Action}></i>
                        : ''
                    }

                    {Object.keys(this.props.arena.enemies).map(key => (
                        <div className={"slot"} key={key}>
                            <img className={"charPicture"} />
                            <div>
                                <div className={"name"}>{ this.props.arena.enemies[key].name }</div>
                                <div className="health-bar">
                                    <div className="current" style={{
                                        width: (this.props.arena.enemies[key].healthPercentage < 3) ? '3%'
                                            : (this.props.arena.enemies[key].healthPercentage > 99) ? '99%'
                                            : this.props.arena.enemies[key].healthPercentage + '%'
                                    }}>&nbsp;</div>
                                    <div className="border">&nbsp;</div>
                                    <span className="text">{ this.props.arena.enemies[key].health } / { this.props.arena.enemies[key].maxHealth }</span>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>

            </div>
        )
    }
}

export default UI