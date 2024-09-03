import React from "react";
import PropTypes from "prop-types";

PrimaryButton.propTypes = {
    type: PropTypes.oneOf(["submit", "button", "reset"]),
    className: PropTypes.string,
    variant: PropTypes.oneOf([
        "primary",
        "secondary",
        "danger",
        "warning",
        "light-outline",
        "white-outline",
    ]),
    processing: PropTypes.bool,
    children: PropTypes.node,
};

export default function PrimaryButton({
    type = "submit",
    className = "",
    variant = "primary",
    processing,
    children,
}) {
    return (
        <button
            type={type}
            className={`inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ${
                processing && "opacity-30"
            } btn-${variant} ${className}`}
            disabled={processing}
        >
            {children}
        </button>
    );
}

