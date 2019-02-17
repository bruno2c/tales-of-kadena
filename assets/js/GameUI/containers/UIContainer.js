import { connect } from 'react-redux'
import UI from "../components/UI";

const mapStateToProps = (state, ownProps) => {
    return {}
}

const mapDispatchToProps = (dispatch, ownProps) => {
    return {}
}

const UIContainer = connect(
    mapStateToProps,
    mapDispatchToProps
)(UI)

export default UIContainer