import { connect } from 'react-redux'
import UI from "../components/UI"
import { changeOption, lockGeneral, unlockGeneral } from '../actions/ui'

const mapStateToProps = (state, ownProps) => {
    return {
        generalAction: state.ui.generalAction,
        lockGeneralAction: state.ui.lockGeneralAction,
        battleAction: state.ui.battleAction,
    }
}

const mapDispatchToProps = (dispatch, ownProps) => {
    return {
        changeOption: (actual, direction) => dispatch(changeOption(actual, direction)),
        lockGeneral: () => dispatch(lockGeneral()),
        unlockGeneral: () => dispatch(unlockGeneral())
    }
}

const UIContainer = connect(
    mapStateToProps,
    mapDispatchToProps
)(UI)

export default UIContainer